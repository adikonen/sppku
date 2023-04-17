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

    public static function getChartData()
    {
        $currentYear = date("Y");
    
        $sql = "SELECT date_format(tanggal_bayar, '%m') as month,sum(nominal) as total
            from transaksi_pembayaran_view WHERE YEAR(tanggal_bayar) = $currentYear
            group by date_format(tanggal_bayar, '%m') ORDER BY date_format(tanggal_bayar, '%m') ";
        
        // $this->db->query($sql);
        // $result = $this->db->resultSet();
        $result = static::$db->query($sql)->resultAll();
        $pemasukan = [];
        $skipedIndexs = [];

        for($i = 0; $i < 12; $i++) {
            
            if(in_array($i,$skipedIndexs)) {
                continue;
            }

            if(!isset($result[$i])) {
                $pemasukan[$i] = 0;
                continue;
            };
            //mengikuti index karena bulan itu start dari 1 sedangkan 
            //array index start nya dari 0
            $month_num = (int) $result[$i]['month'] - 1; 
            if($i == $month_num) {
                $pemasukan[$i] = $result[$i]['total'];
            }
            else {
                $pemasukan[$month_num] = $result[$i]['total'];
                $pemasukan[$i] = 0;
                $skipedIndexs[] = $month_num;  
            }      
        }
        
        $output = [];

        // sorting
        for($i = 0; $i < 12; $i++) {
            $output[$i] = $pemasukan[$i];
        }

        return $output;
    }
}
