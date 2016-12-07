<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.16
 * Time: 09:54
 */

namespace Tender\User;

use Illuminate\Database\Eloquent\Model as Eloquent;


class User extends Eloquent
{
    protected $table = 'members';
    protected $fillable = [
        'uniq_identifier',
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'company',
        'juro_address',
        'post_address',
        'person_office',
        'phone_number',
        'egrpou',
        'iso9011',
        'curent_tender',
        'curent_price',
        'active',
        'active_hash',
        'recover_hash',
        'remember_identifier',
        'remember_token',
    ];

    public function getFullName()
    {
        if (!$this->first_name || !$this->last_name) {
            return null;
        } else {
            return "{$this->first_name} {$this->last_name}";
        }
    }

    public function getFullNameOrUsername()
    {
        return $this->getFullName() ?: $this->username;
    }

    public function activateAccount()
    {
        $this->update([
            'active' => true,
            'active_hash' => null
        ]);
    }

    public function updateRememberCredentials($identifier, $token)
    {
        $this->update([
            'remember_identifier' => $identifier,
            'remember_token' => $token
        ]);
    }

    public function removeRememberCredentials()
    {
        $this->updateRememberCredentials(null, null);
    }

    public function hasPermission($permission)
    {
        return (bool)$this->permission->{$permission};
    }

    public function isAdmin()
    {
        return $this->hasPermission('is_admin');
    }

    public function permission()
    {
        return $this->hasOne('Tender\User\UserPermission', 'user_id');
    }
}