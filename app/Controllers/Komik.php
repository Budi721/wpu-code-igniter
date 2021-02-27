<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\Database\Config;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->KomikModel = new KomikModel();
    }

    public function index()
    {

        $komik = $this->KomikModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $komik
        ];

        // Cara Konek DB tanpa Model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row){
        //    d($row);
        // }

        return view('komik/index', $data);
    }
}
