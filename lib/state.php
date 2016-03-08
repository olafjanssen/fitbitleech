<?php
session_start();

/**
 * Created by IntelliJ IDEA.
 * User: olafjanssen
 * Date: 01/02/16
 * Time: 21:17
 */
class State {

  public static function accessToken() {
    return array_key_exists('access_token', $_SESSION) ? $_SESSION['access_token'] : null;
  }

  public static function setAccessToken($accessToken) {
    $_SESSION['access_token'] = $accessToken;
  }

  public static function refreshToken() {
    return $_COOKIE['rt'];
  }

  public static function setRefreshToken($refreshToken) {
    setcookie('rt', $refreshToken, time() + 3600 * 24 * 30, '/', Config::baseDomain(), true, true);
  }

  public static function oauthStateUri() {
    if (array_key_exists('oauthState', $_SESSION)) {
      var_dump(base64_decode($_SESSION['oauthState']));
      $data = explode(',', base64_decode($_SESSION['oauthState']), 2);
      return $data[1];
    }
    return null;
  }

  public static function oauthState() {
    return array_key_exists('oauthState', $_SESSION) ? $_SESSION['oauthState'] : null;
  }

}
