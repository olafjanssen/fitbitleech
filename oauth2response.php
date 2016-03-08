<?php
/**
 * Created by IntelliJ IDEA.
 * User: olafjanssen
 * Date: 21/01/16
 * Time: 14:58
 */
require_once('lib/config.php');
require_once('lib/state.php');

// exchange code for token
if (!$_GET['error'] && $_GET['code'] && $_GET['state'] === State::oauthState()) {

  $code = $_GET['code'];
  $uri = urlencode(Config::oauthCallbackURI());

  $data = array('client_id' => Config::clientId(State::canvasDomain()),
    'redirect_uri' => urlencode($uri),
    'client_secret' => rawurlencode(Config::clientSecret(State::canvasDomain())),
    'code' => $code,
    'grant_type' => 'authorization_code');

  $ch = curl_init('https://' . State::canvasDomain() . '/login/oauth2/token');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  $result = json_decode($result, true);
  $token = $result['access_token'];

  State::setAccessToken($result['access_token']);
  State::setRefreshToken($result['refresh_token']);

  header('Location: '. State::oauthStateUri());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Digital Dummy - authorization</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="bower_components/normalize-css/normalize.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/dailysnapshot.css">
  <link rel="stylesheet" href="css/pong.css">

  <script src="js/moment.min.js"></script>
</head>
<body>
<header>
  <h1>Digital Dummy</h1>
  <h2>You've moved mountains today!</h2>

  <div id="select-wrapper">
    <select id="student-filter" title="Student filter">
      <option>Show all</option>
    </select>
  </div>
</header>

<section id="student-blog" class="container">
  <a href="<?php echo State::oauthStateUri(); ?>">return</a>
</section>
</body>
</html>

