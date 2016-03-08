<?php

/**
 * Configuration parameters
 *
 * User: olafjanssen
 * Date: 01/12/15
 * Time: 13:13
 */
class Config {

    public static function clientId() {
        return 'clientId';
    }

    public static function clientSecret() {
        return 'clientSecret';
    }

    public static function baseDomain() {
        return 'i876011.iris.fhict.nl';
    }

    public static function baseURI() {
        return 'https://i876011.iris.fhict.nl/fitbitleech';
    }

    public static function oauthCallbackURI() {
        return self::baseURI() . '/callback.php';
    }

    public static function mainAppkURI() {
        return self::baseURI() . '/index.php';
    }

    public static function OAuthURI() {
        return 'https://www.fitbit.com/oauth2/authorize';
    }

    public static function OAuthTokenURI() {
        return 'https://api.fitbit.com/oauth2/token';
    }

}
