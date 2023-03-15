<?php

/**
 * Model for pengguna
 */
class Pengguna extends Model
{
    protected static $primaryKey = 'id';
    protected static $table = 'pengguna';

    /**
     * select * from pengguna where username is $username
     * @param string $username
     * @return array
     */
    public static function findByUsername($username)
    {
        return static::$db->query('CALL findByUsername(:username)')
            ->bind(':username', $username)
            ->resultSingle();
    }
}
