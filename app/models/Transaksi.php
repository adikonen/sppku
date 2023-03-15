<?php

/**
 * Model for transaksi table
 */
class Transaksi extends Model
{
    protected static $primaryKey = 'id';
    protected static $table = 'transaksi';

    /**
     * get all passed payment by siswa_id and tahun_ajaran
     * @param int $siswa_id
     * @param int $tahun_ajaran
     * @return array
     */
    public static function getAllPassedPayment($siswa_id, $tahun_ajaran)
    {
        return static::$db->query("SELECT bulan_dibayar FROM transaksi_pembayaran_view WHERE siswa_id = :siswa_id AND tahun_ajaran = :tahun_ajaran")
            ->bind(':siswa_id',$siswa_id)
            ->bind(':tahun_ajaran',$tahun_ajaran)
            ->flat();
    }

    /**
     * get nominal by tahun ajaran
     * @param int $tahun_ajaran
     * @return int
     */
    public static function getNominal($tahun_ajaran)
    {
        return static::$db->query('SELECT nominal FROM pembayaran WHERE tahun_ajaran = :t')
            ->bind(':t',$tahun_ajaran)
            ->flat()[0];
    }

    /**
     * count the id where tahun ajaran = $tahun
     * @param int $tahun
     * @return int
     */
    public static function countData($tahun)
    {
        return static::$db->query("SELECT id FROM transaksi_pembayaran_view WHERE tahun_ajaran = :t")
        ->bind(':t',$tahun)
        ->rowCount();
    }
}
