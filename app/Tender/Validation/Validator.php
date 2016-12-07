<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21.11.16
 * Time: 09:32
 */
namespace Tender\Validation;

use Violin\Violin;

use Tender\User\User;
use Tender\Helpers\Hash;

class Validator extends Violin
{
    protected $user;
    protected $hash;
    protected $auth;

    public function __construct(User $user, Hash $hash, $auth = null)
    {
        $this->user = $user;
        $this->hash = $hash;
        $this->auth = $auth;

        $this->addFieldMessage('email', 'uniqueEmail', 'Такой email уже зарегистрирован');
        $this->addFieldMessage('username', 'uniqueUsername', 'Имя пользователя уже используется');
        $this->addFieldMessage('old_password', 'matchesCurrentPassword', 'Пароль не соответсвует текущему');
    }

    public function validate_uniqueEmail($value, $input, $args)
    {
        if ($this->auth && $this->auth->email === $value) {
            return true;
        }

        return !(bool)$this->user->where('email', $value)->count();
    }

    public function validate_uniqueUsername($value, $input, $args)
    {
        return !(bool)$this->user->where('username', $value)->count();
    }

    public function validate_matchesCurrentPassword($value, $input, $args)
    {
        if ($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) {
            return true;
        }

        return false;
    }
}