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
        if (empty($data['komik'])) {
            throw new PageNotFoundException("Judul komik $slug tidak ditemukan.");
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];

        return view('/komik/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // Apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // Ambil nama file
            $namaSampul = $fileSampul->getRandomName();

            // Pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }


        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->KomikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        // Cari gambar berdasarkan id
        $komik = $this->KomikModel->find($id);

        // Cek apakah gambar yang digunakan default
        if ($komik['sampul'] != 'default.jpg') {
            // Hapus gambar
            unlink('img/' . $komik['sampul']);
        }

        $this->KomikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->KomikModel->getKomik($slug)
        ];

        return view('/komik/edit', $data);
    }

    public function update($id)
    {
        // Cek Judul
        $komikLama = $this->KomikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $ruleJudul = 'required';
        } else {
            $ruleJudul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $ruleJudul,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // Cek apakah tetap gambar lama
        if ($fileSampul->getError() == 4){
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();

            $fileSampul->move('img', $namaSampul);

            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->KomikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/komik');
    }
}
