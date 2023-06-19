<?php

namespace minipress\app\services\utils;

use Exception;
use minipress\app\services\exceptions\ExceptionTokenGenerate;
use minipress\app\services\exceptions\ExceptionTokenVerify;

class CsrfService
{
    /**
     * @throws ExceptionTokenGenerate
     */
    public static function generate():string
    {
        try {
            $token = bin2hex(random_bytes(64));
        } catch (Exception $e) {
            throw new ExceptionTokenGenerate();
        }
        $_SESSION['csrf'] = $token;
        return $token;
    }

    /**
     * @throws ExceptionTokenVerify
     */
    public static function check($token):void
    {
        $sessionToken = $_SESSION['csrf'];
        unset($_SESSION['csrf']);
        if ($token !== $sessionToken) {
            throw new ExceptionTokenVerify('Token invalide');
        }
    }
}