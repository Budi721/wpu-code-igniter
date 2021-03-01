<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\Database\Config;
use CodeIgniter\Exceptions\PageNotFoundException;

class Komik extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->KomikModel = new KomikModel();
    }

    public function index()
    {

        // $komik = $this->KomikModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->KomikModel->getKomik()
        ];

        // Cara Konek DB tanpa Model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row){
        //    d($row);
        // }

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->KomikModel->getKomik($slug)
        ];

        // Jika komik tidak ada di tabel
        if (empty($data['komik'])){
            throw new PageNotFoundException("Judul komik $slug tidak ditemukan.");
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Komik'
        ];

        return view('/komik/create', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->KomikModel->save([
           'judul' => $this->request->getVar('judul'),
           'slug' => $slug,
           'penulis' => $this->request->getVar('penulis'),
           'penerbit' => $this->request->getVar('penerbit'),
           'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/komik');
    }
}
