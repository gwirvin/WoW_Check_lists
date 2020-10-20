<?php
/** file: wow_char_inc.php 
 * All we are doing here is getting the character object
 * from the Blizzard WOW API.
 * There are other fields that might be of more interest
 * for raiders (i.e. audit to see unenchanted/ungemmed gear)
 * but I have no interest in that for a simple next expansion 
 * ready check list.
 * The other fields can be found at:
 * https://dev.battle.net/io-docs **/
# Using a curl function to get info
function getToonInfo ($toon_info_url, array $get = NULL, array $options = array()) {
	$defaults = array(
		CURLOPT_URL => $toon_info_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	return $result;
}

function getToonRepInfo ($toonRepsUrl, array $get = NULL, array $options = array())
{
	$defaults = array(
		CURLOPT_URL => $toonRepsUrl,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	return json_decode($result);
}

function getToonMediaInfo ($toonMediaUrl, array $get = NULL, array $options = array())
{
	$defaults = array(
		CURLOPT_URL => $toonMediaUrl,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	return json_decode($result);
}
function getToonProfsInfo ($toonProfsUrl, array $get = NULL, array $options = array())
{
//	$apiResponse = get_headers($toonProfsUrl, 1);
//	if (strpos ( $apiResponse[0], '200OK'))
//	{
		$defaults = array(
			CURLOPT_URL => $toonProfsUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache"
			),
		);
		$ch = curl_init();
		curl_setopt_array($ch, ($options + $defaults));
		if ( !$result = curl_exec($ch))
		{
			trigger_error(curl_error($ch));
		}
		curl_close($ch);
		return json_decode($result);
//	} else {
//		return null;
//	}
}


function getUserPrimaryToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow) {
	$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbWow);
	$myArray = array();
	$toon_sql = ("SELECT toon_name, toon_slug, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" AND toon_primary=\"Yes\" ORDER BY toon_realm, toon_slug");
	if ($result = $mysqli->query($toon_sql)) {
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$myArray[] = $row;
		}
	$myArray = json_decode(json_encode($myArray));
	return $myArray;
	}
	$result->close();
	$mysqli->close();
}

function getUserSecondaryToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow) {
	$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbWow);
	$myArray = array();
	$toon_sql = ("SELECT toon_name, toon_slug, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" AND toon_primary=\"No\" ORDER BY toon_realm, toon_slug");
	if ($result = $mysqli->query($toon_sql)) {
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$myArray[] = $row;
		}
	$myArray = json_decode(json_encode($myArray));
	return $myArray;
	}
	$result->close();
	$mysqli->close();
}

function toonUrlArray ($allUserToons, $wowUrl, $wowFields, $myOauthToken) {
	$urlArray = array ();
	foreach ($allUserToons as $toon) {
//		$urlArray[] = $wow_url."character/".$toon->toon_realm."/".$toon->toon_name."?".$wowFields."&locale=en_US&".$api_key;
		$urlArray[] = $wowUrl."character/".$toon->toon_realm."/".$toon->toon_name."?".$wowFields."&locale=en_US&access_token=".$myOauthToken;
	}
	return $urlArray;
}

function toonCommunityUrlArray ($allUserToons, $myOauthToken) {
	$uriArray = array ();
	foreach ($allUserToons as $toon) {
		$uriArray[] = "https://us.api.blizzard.com/profile/wow/character/".$toon->toon_realm."/".$toon->toon_slug."?namespace=profile-us&locale-en_US&access_token=".$myOauthToken;
	}
	return $uriArray;
}

function getAllToonObjArray ($allUserToonData, $userToonCount) {
	$allToonsObj = array();
	for ($userToonCounter = 0; $userToonCounter < $userToonCount; $userToonCounter++) {
		$allToonsObj[] = json_decode($allUserToonData[$userToonCounter]);
	}
	return $allToonsObj;
}

//SANI: Class for multi request API
class multiapi
{
	//SANI: Declairing variables
	public $data;
	
	//SANI: Constructor
	function __construct() 
	{
       $this->data = array(); //SANI: Initializing variable
	}
	
	
	public function post_process_requests()
	{
		//SANI: POST
		$response = $this->multiple_post_requests($this->data);
		return $response;
	}
	
	public function get_process_requests()
	{
		//SANI: GET
		$response = $this->multiple_get_requests($this->data);
		return $response;
	}
   
    //SANI: Curl to process multiple POST requests
	function multiple_post_requests($data, $options = array()) 
	{
		 $curly 	= array();
		 $result 	= array();
		 $mh 		= curl_multi_init();
		 //echo "<pre>"; print_r($data); die();
		 foreach ($data as $id => $d) 
		 {
		 	
			$curly[$id] = curl_init();
		 	$url 		= (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
			
			curl_setopt($curly[$id], CURLOPT_URL,            $url);
			curl_setopt($curly[$id], CURLOPT_HEADER,         0);
			curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curly[$id], CURLOPT_TIMEOUT, 4);
			curl_setopt($curly[$id], CURLOPT_CONNECTTIMEOUT, 4);
		 
			if (is_array($d)) 
			{ 
			  if (!empty($d['post'])) 
			  { 
			  	curl_setopt($curly[$id], CURLOPT_POST,       1);
				
			  	if(!empty($d['post']['auth']))
				{
					$headers  = $d['post']['auth']["headers"];
					$username = $d['post']['auth']["username"];
					$password = $d['post']['auth']["password"];
					$string   = $d['post']['auth']["string"];
					
					if(!empty($d['post']['auth']["headers"]))
					{
						curl_setopt($curly[$id], CURLOPT_HTTPHEADER, $headers);
					}
					
					if(!empty($d['post']['auth']["username"]) && !empty($d['post']['auth']["password"]))
					{
						curl_setopt($curly[$id], CURLOPT_USERPWD, "$username:$password");
					}
					curl_setopt($curly[$id], CURLOPT_POSTFIELDS,    $string); 
				}else{
						curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
					 }		
			  }
			}
			
			
		 
			if (!empty($options)) {  curl_setopt_array($curly[$id], $options); }
		    curl_multi_add_handle($mh, $curly[$id]);
		  }
		 
		  $running = null;
		  do { curl_multi_exec($mh, $running);  } while($running > 0);
		  foreach($curly as $id => $c) {	$result[$id] = curl_multi_getcontent($c); curl_multi_remove_handle($mh, $c);  }
		  curl_multi_close($mh);
		 
		  return $result;
	}
	
	
	 //SANI: Curl to process multiple GET requests
	function multiple_get_requests($data, $options = array()) 
	{
 
	  $curly 	= array();
	  $result 	= array();
	  $mh 		= curl_multi_init();
	 
	  foreach ($data as $id => $d)
	  {
	 
		$curly[$id] = curl_init();
	 
		$url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
		curl_setopt($curly[$id], CURLOPT_URL,            $url);
		curl_setopt($curly[$id], CURLOPT_HEADER,         0);
		curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
	 
		if (is_array($d)) 
		{
		  if (!empty($d['post'])) 
		  {
			curl_setopt($curly[$id], CURLOPT_POST,       1);
			curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
		  }
		}
	 
		if (!empty($options)) {  curl_setopt_array($curly[$id], $options);}
	 
		curl_multi_add_handle($mh, $curly[$id]);
	  }
	 
	  $running = null;
	  do {
			curl_multi_exec($mh, $running);
		  } while($running > 0);
	 
	  foreach($curly as $id => $c) 
	  {
		$result[$id] = curl_multi_getcontent($c);
		curl_multi_remove_handle($mh, $c);
	  }
	 
	  curl_multi_close($mh);
	 
	  return $result;
	}
	 
	
	//SANI: Disctructor
	function __destruct() 
	{
       
    }
	
}
$obj = new multiapi();
///////////////////////////// POST  ////////////////////////////////////
/*
//SANI: request one
$obj->data[0]['url'] 	 		  = 'https://www.xxx.com/xxxx';
$obj->data[0]['post'] 			  = array();
$obj->data[0]['post']['sec_key']  = 'xxxxxxx';
$obj->data[0]['post']['xxxx']     = 'xxxxxxxxxx';
//SANI: request two
$obj->data[1]['url'] 	 		  		  = 'http://wwww.xxxxx.com/xxx';
$obj->data[1]['post'] 			  		  = array();
$obj->data[1]['post']['sec_key']   		  = 'xxxxxxx';
$obj->data[1]['post']['xxxx']  	  		  = 'xxxxx';
$obj->data[1]['post']['xxxxxxxx']	  	  = 'xxxxxxx';
$result = $obj->post_process_requests();
echo "<pre>"; print_r($result);
*/
///////////////////////////// GET  ////////////////////////////////////
//SANI: GET DATA
//$obj->data = array(
//					  'http://wwww.xxxxx.com/xxxxx',
//					  'http://wwww.xxxxx.com/xxxxx',
//					  'http://wwww.xxxxx.com/xxxxx',
//					);
////SANI: GET DATA	
//$result = $obj->get_process_requests();
//echo "<pre>"; print_r($result);
//////////////////////////////////////////////////////////////////////////////////

?>
