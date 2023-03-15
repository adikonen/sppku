<?php

class Role
{
    /**
     * @var int ADMIN
     * flag for admin role
     */
    PUBLIC CONST ADMIN = 1;

    /**
     * @var int petugas
     * flag for petugas role
     */
    PUBLIC CONST PETUGAS = 2;

    /**
     * @var int siswa
     * flag for siswa role
     */
    PUBLIC CONST SISWA = 3;

    /**
     * data set
     */
    protected static $data = [
        1 => 'admin',
        2 => 'petugas',
        3 => 'siswa'
    ];

    /**
     * get role name from role number
     * @return string|null 
     */
    public static function get($role_num)
    {
        return static::$data[$role_num] ?? null;        
    }
}