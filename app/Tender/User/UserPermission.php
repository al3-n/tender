<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.16
 * Time: 20:34
 */

namespace Tender\User;

use Illuminate\Database\Eloquent\Model as Eloquent;


class UserPermission extends Eloquent
{
    protected $table = "members_permissions";
    protected $fillable = [
        'is_admin'
    ];

    public static $default = [
        'is_admin' => false
    ];
}