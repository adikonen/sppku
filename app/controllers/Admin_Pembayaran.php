<?php


importModel('pembayaran');

/**
 * Handle request with prefix /admin_pembayaran
 */
class Admin_Pembayaran extends AdminController
{
    /**
     * only admin have access to run all method
     */
    public function __construct()
    {
        parent::__construct();
        admin_only();
    }

    /**
     * display all pembayaran
     */
    public function index()
    {
        $data = [
            'all_pembayaran' => Pembayaran::all()
        ];
        return $this->render('pembayaran/index', $data);
    }

    /**
     * display create form for pembayaran
     */
    public function create()
    {
        return $this->render('pembayaran/create');
    }

    /**
     * display edit form for pembayaran
     */
    public function edit($id)
    {
        $data = [
            'pembayaran' => Pembayaran::find($id),
        ];
        return $this->render('pembayaran/edit',$data);
    }

    /**
     * create new pembayaran where data is sended from create
     */
    public function store()
    {
        $request = new Request();
        $form = $request->only('nominal','tahun_ajaran');
        Pembayaran::create($form);
        Flasher::set('success', 'Berhasil membuat pembayaran.');
        return redirect('admin_pembayaran');
    }

    /**
     * update the pembayaran from given id
     * @param int $id
     */
    public function update($id)
    {
        $request = new Request();
        $form = $request->only('nominal','tahun_ajaran');
        Pembayaran::update($id,$form);
        Flasher::set('success', 'Berhasil mengubah pembayaran.');
        return redirect('admin_pembayaran');
    }

    /**
     * delete pembayaran from id
     * Error will occured, when restricted foreign key and ON_DEVELOPMENT is true
     * @param int $id
     * @throws Exception
     */
    public function destroy($id)
    {
        Flasher::set('success', 'Berhasil menghapus pembayaran.');

        try {
            Pembayaran::delete($id);
        } catch (Exception $err) {
            Flasher::set('danger', 'Gagal menghapus pembayaran. pembayaran ini memiliki relasi dengan data lainnya');
            ErrorHandler::log($err, 'delete pembayaran', ['id_pembayaran' => $id]);
        }

        return redirect('admin_pembayaran');
    }
}