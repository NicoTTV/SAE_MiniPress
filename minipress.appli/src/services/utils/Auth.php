<?php

namespace minipress\app\services\utils;

use Exception;
use minipress\app\models\User;
use minipress\app\services\exceptions\BadDataUserException;
use minipress\app\services\exceptions\UserNotFoundException;
use minipress\app\services\exceptions\UserRegisterException;

class Auth
{
    /**
     * @param string $email
     * @return array
     * @throws BadDataUserException
     * @throws UserNotFoundException
     */
    public static function getUserByLogin(string $email):array
    {

        if (empty($email))
            throw new BadDataUserException("Bad data user : empty");

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new BadDataUserException("Bad data user : not a valid email");

        if ($email !== filter_var($email, FILTER_SANITIZE_EMAIL))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        try {
            return User::where('email', '=', $email)->get()->toArray();
        }catch (Exception $e){
            throw new UserNotFoundException($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws BadDataUserException
     * @throws UserNotFoundException
     */
    public static function connexion(array $data): bool
    {
        if (!isset($data['password']) || !isset($data['email']))
            throw new BadDataUserException("Bad data user : empty");

        if ($data['password'] !== filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        $user = self::getUserByLogin($data['email']);
        if (empty($user))
            throw new UserNotFoundException("User not found");

        if (!password_verify($data['password'], $user[0]['password']))
            throw new BadDataUserException("Bad data user : password not valid");

        $_SESSION['user'] = serialize($user);
        return true;
    }


    /**
     * @param array $data
     * @return bool
     * @throws BadDataUserException
     * @throws UserNotFoundException
     * @throws UserRegisterException
     */
    public static function inscription(array $data): bool
    {
        if (!isset($data['password']) || !isset($data['email']) || !isset($data['passwordVerify']) || !isset($data['pseudo']))
            throw new BadDataUserException("Bad data user : empty");

        if ($data['password'] !== filter_var($data['password'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/']]))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        if ($data['email'] !== filter_var($data['email'], FILTER_SANITIZE_EMAIL))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        if ($data['pseudo'] !== filter_var($data['pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
            throw new BadDataUserException("Bad data user : not a sanitize pseudo");

        $user = self::getUserByLogin($data['email']);
        if (!empty($user))
            throw new BadDataUserException("Bad data user : email already exist");

        if ($data['password'] !== $data['passwordVerify'])
            throw new BadDataUserException("Bad data user : password don't match");


        try {
            $user = new User();
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->pseudo = $data['pseudo'];
            $user->saveOrFail();
        } catch (\Throwable $e) {
            throw new UserRegisterException("Error when register user");
        }
        $_SESSION['user'] = serialize($user);
        return true;
    }

    /**
     * @throws UserNotFoundException
     * @throws BadDataUserException
     * @throws UserRegisterException
     */
    public static function inscriptionByAdmin(array $data): bool
    {
        if (!isset($data['password']) || !isset($data['email']))
            throw new BadDataUserException("Bad data user : empty");

        if ($data['password'] !== filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        $user = self::getUserByLogin($data['email']);
        if (!empty($user))
            throw new BadDataUserException("Bad data user : email already exist");

        try {
            $user = new User();
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->pseudo = null;
            $user->saveOrFail();
        } catch (\Throwable $e) {
            throw new UserRegisterException("Error when register user");
        }
        return true;
    }

    public static function getCurrentUser(): array|null
    {
        if (isset($_SESSION['user']))
            return unserialize($_SESSION['user'])[0];
        return null;
    }

}