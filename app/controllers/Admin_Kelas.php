<?php

importModel('kelas');

/**
 * handle request with prefix /admin_kelas
 */
class Admin_Kelas extends AdminController
{
    /**
     * display all kelas
     */
    public function index()
    {
        $data = [
            'all_kelas' => Kelas::all()
        ];
        return $this->render('kelas/index', $data);
    }

    /**
     * display create form for kelas
     */
    public function create()
    {
        return $this->render('kelas/create');
    }

    /**
     * display edit form for kelas
     */
    public function edit($id)
    {
        $data = [
            'kelas' => Kelas::find($id),
        ];
        return $this->render('kelas/edit',$data);
    }

    /**
     * create new Kelas
     */
    public function store()
    {
        $request = new Request();
        $form = $request->only('nama_kelas','kompetensi_keahlian');
        Kelas::create($form);
        Flasher::set('success', 'Berhasil membuat kelas.');
        return redirect('admin_kelas');
    }

    /**
     * update kelas from id
     * @param int $id
     */
    public function update($id)
    {
        $request = new Request();
        $form = $request->only('nama_kelas','kompetensi_keahlian');
        Kelas::update($id,$form);
        Flasher::set('success', 'Berhasil mengubah kelas.');
        return redirect('admin_kelas');
    }

    /**
     * delete kelas from id
     * Error will occured, when restricted foreign key and ON_DEVELOPMENT is true
     * @param int $id
     * @throws Exception
     */
    public function destroy($id)
    {
        Flasher::set('success', 'Berhasil menghapus kelas.');

        try {
            Kelas::delete($id);
        } catch (Exception $err) {
            Flasher::set('danger', 'Gagal menghapus kelas. kelas yang sudah ada siswanya tidak dapat dihapus');
            ErrorHandler::log($err, 'delete kelas', ['id_kelas' => $id]);
        }

        return redirect('admin_kelas');
    }
}