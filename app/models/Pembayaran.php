<?php

/**
 * Model for Pembayaran table
 */
class Pembayaran extends Model
{
    protected static $primaryKey = 'id';
    protected static $table = 'pembayaran';

    /**
     * get the next id from given tahun_ajaran
     * @param int $tahun_ajaran
     * @return int|null
     */
    public static function nextId($tahun_ajaran)
    {
        return static::$db->query('SELECT id FROM pembayaran WHERE tahun_ajaran = :t')
            ->bind(':t', $tahun_ajaran+1)
            ->resultSingle()['id'] ?? null;
    }

    /**
     * get list pembayaran for siswa
     * @param int $tahun_mulai
     * @return array
     */
    public static function forSiswa($tahun_mulai)
    {
        $active_tahun = [
            $tahun_mulai, $tahun_mulai+1, $tahun_mulai+2
        ];

        $years = implode(',',$active_tahun);
        return static::$db->query("SELECT * FROM pembayaran WHERE tahun_ajaran in ($years)")
            ->resultAll();
    }

   
}
