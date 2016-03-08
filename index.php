<?php
require_once('lib/config.php');
require_once('lib/state.php');
///*
if (!State::refreshToken()) {
    // log in
    $uri = Config::OAuthURI() . '?client_id=' . urlencode(Config::clientId()) . '&response_type=code&redirect_uri=' . urlencode(Config::oauthCallbackURI()) . '&state=' . State::oauthState();
    header('Location: ' . $uri);
} else {
    // refresh the access token
    $data = array('client_id' => Config::clientId(),
        'redirect_uri' => urlencode($uri),
        'client_secret' => rawurlencode(Config::clientSecret()),
        'refresh_token' => State::refreshToken(),
        'grant_type' => 'refresh_token');

    $ch = curl_init(Config::OAuthTokenURI());
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    State::setAccessToken($result['access_token']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fitbit data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
</head>
<body>
</body>
</html>
