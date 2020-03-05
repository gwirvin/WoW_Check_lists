<?php
/* file: wow.php */
/* General info per user on wow toons */

// Initialize the session
//session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION) || empty($_SESSION)) {
        $userId = $_REQUEST['user_id'];
        } else {
        $userId = $_SESSION['user_id'];
        }
if (!isset($_SESSION) || empty($_SESSION)) {
        $toon_owner_first = $_REQUEST['user_first'];
        } else {
        $toon_owner_first = $_SESSION['user_first'];
	}

# Using a curl function to get info
function getToonInfo ($toon_info_url, array $get = NULL, array $options = array())
{
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

function getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow) {
	$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbWow);
	$myArray = array();
	$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_name");
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

//function toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key) {
function toonUrlArray ($allUserToons, $wowUrl, $wowFields, $myOauthToken) {
	$urlArray = array ();
	foreach ($allUserToons as $toon) {
//		$urlArray[] = $wow_url."character/".$toon->toon_realm."/".$toon->toon_name."?".$wowFields."&locale=en_US&".$api_key;
		$urlArray[] = $wowUrl."character/".$toon->toon_realm."/".$toon->toon_name."?".$wowFields."&locale=en_US&access_token=".$myOauthToken;
	}
	return $urlArray;
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


$blizzardApiBase = "https://us.api.blizzard.com";
$blizzardOauthTokenUrl = "https://us.battle.net/oauth/token";
$blizzardOauthAuthUrl = "https://us.battle.net/oauth/authorize";
$blizzLocale = "locale=en_US";
$clientId = "2abc5bd3a1d64274a2aa9575404cf0e9";
$clientSecret = "4lDDBAihtzLRkljrtYmwRTL1L6xZeOGv";
$blizzardAuthorizeUrl = "https://us.battle.net/oauth/authorize";
$wowCommuniutyUserChars = "/wow/user/characters?";

$toonCounter = 0;
$char_url = $wowUrl."character/";
$wowFields = "fields=reputation,professions,talents,titles,items";
//$wowLocale = "locale=en_US";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];

$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons
// $allToonUrls = toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key); // Creating an array of all the API calls
$allToonUrls = toonUrlArray ($allUserToons, $wowUrl, $wowFields, $myOauthToken); // Creating an array of all the API calls using OAuth

/* Using the borrow MultiAPI classes to get all the toon data concurently */
$allToonApiArray = new multiapi();
$allToonApiArray->data = $allToonUrls;
$allToonDataArray = $allToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* Converting the strings returned int he multiapi to an array fo objects */
$allToonsObjArray = getAllToonObjArray($allToonDataArray, $userToonCount);

$wowCharProfile = $blizzardApiBase."/profile".$wowCommunityUserChars
?>

