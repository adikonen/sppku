<?php

/**
 * Model for siswa table
 */
class Siswa extends Model
{
    protected static $primaryKey = 'pengguna_id';
    protected static $table = 'siswa';

    public static function getCurrentTahunAjaran($id)
    {
        return static::$db->query('SELECT tahun_ajaran FROM pembayaran WHERE id = (
            SELECT pembayaran_id FROM siswa WHERE id = :id
        )')
        ->bind(':id',$id)
        ->resultSingle()['tahun_ajaran'];
    }

    public static function generateNIS()
    {
        $latest_nis = static::$db->query('SELECT nis FROM siswa ORDER BY id DESC LIMIT 1')
            ->resultSingle()['nis'];

        // get new nis
        return $latest_nis + 1;
    }
}
