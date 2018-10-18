<?php

if (isset($_GET['code'])) {
    // try to get an access token
    $code = $_GET['code'];
    $url = 'https://accounts.google.com/o/oauth2/token';
    $params = array(
        "code" => $code,
        "client_id" => YOUR_CLIENT_ID,
        "client_secret" => YOUR_CLIENT_SECRET,
        "redirect_uri" => 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"],
        "grant_type" => "authorization_code"
    );

    $ch = curl_init();
    curl_setopt($ch, constant("CURLOPT_" . 'URL'), $url);
    curl_setopt($ch, constant("CURLOPT_" . 'POST'), true);
    curl_setopt($ch, constant("CURLOPT_" . 'POSTFIELDS'), $params);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    if ($info['http_code'] === 200) {
        header('Content-Type: ' . $info['content_type']);
        return $output;
    } else {
        return 'An error happened';
    }
} else {

    $url = "https://accounts.google.com/o/oauth2/auth";

    $params = array(
        "response_type" => "code",
        "client_id" => YOUR_CLIENT_ID,
        "redirect_uri" => 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"],
        "scope" => "https://www.googleapis.com/auth/plus.me"
    );

    $request_to = $url . '?' . http_build_query($params);

    header("Location: " . $request_to);
}

?>
