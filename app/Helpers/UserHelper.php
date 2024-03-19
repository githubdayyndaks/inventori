<?php


namespace App\Helpers;

class UserHelper
{
    public static function isAdmin($user)
    {
        return $user->level === 'admin'; // Sesuaikan dengan nama atribut level pada model User
    }
}