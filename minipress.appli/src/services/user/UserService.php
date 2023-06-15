<?php

namespace minipress\app\services\user;

use Exception;
use minipress\app\models\User;
use minipress\app\services\exceptions\BadDataUserException;
use minipress\app\services\exceptions\UserNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;

class UserService
{
    /**
     * @throws UserNotFoundException
     * @throws BadDataUserException
     */
    public function getUserByLogin(string $email):array
    {

        if (empty($email))
            throw new BadDataUserException("Bad data user : empty");

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new BadDataUserException("Bad data user : not a valid email");

        if ($email !== filter_var($email, FILTER_SANITIZE_EMAIL))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        try {
            return User::where('email', '=', $email)->toArray();
        }catch (Exception $e){
            throw new UserNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws UserNotFoundException
     * @throws BadDataUserException
     */
    public function connexion(array $data): bool
    {

        if (!isset($data['password']) || !isset($data['email']))
            throw new BadDataUserException("Bad data user : empty");

        if ($data['password'] !== filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
            throw new BadDataUserException("Bad data user : not a sanitize email");

        $user = $this->getUserByLogin($data['email']);
        if (empty($user))
            throw new UserNotFoundException("User not found");

        if (!password_verify($data['password'], $user['password']))
            throw new BadDataUserException("Bad data user : password not valid");

        $_SESSION['user'] = $user;
        return true;
    }
}