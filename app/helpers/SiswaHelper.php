<?php 

/**
 * helper clas just for validate
 * make sure has import model pembayaran and siswa for use this helper
 */
class SiswaHelper
{
    public function validateTahunMulai($tahun_ajaran)
    {
        $count = count(Pembayaran::select('tahun_ajaran')
            ->whereFor('tahun_ajaran','>', $tahun_ajaran)
            ->get());

        $error = [$tahun_ajaran + 1, $tahun_ajaran + 2];

        if ($count >= 2) {
            return $this;
        }

        if ($count == 1) {
            array_pop($error);
        }

        $years = implode(' dan ',$error);

        Flasher::set('danger', "Buat data referensi pembayaran dengan angka tahun {$years} terlebih dahulu");
        return redirect('admin_pembayaran');
    }

    /**
     * @param string $nis
     * @param string $nisn
     * 
     * redirect location when validated
     * @param string $redirect_path
     */
    public function validateNisAndNisn($nis, $nisn, $redirect_path = 'admin_siswa/create')
    {
        $countNis = count(Siswa::select('nis')
            ->where(['nis' => $nis])
            ->get());
        
        $countNisn = count(Siswa::select('nisn')
            ->where(['nisn' => $nisn])
            ->get());

        $error = ["nis sudah terdaftar", "nisn sudah terdaftar"];

        // given nis should not in db, because its unique
        if ($countNis == 0) {
            unset($error[0]);
        }

        if ($countNisn == 0) {
            unset($error[1]);
        }

        if ($error != []) {
            $message = implode(' dan ', $error);
            Flasher::set('danger', "kesalahan, $message dalam sistem");
            return redirect($redirect_path);
        }

        // if not error, return $this for chaining validate
        return $this;
    }
}