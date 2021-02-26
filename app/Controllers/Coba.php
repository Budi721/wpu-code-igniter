<?php

namespace App\Controllers;

class Coba extends BaseController
{
	public function index()
	{
		echo 'Ini controller coba method index';
	}

	public function about($nama = '', $umur = 0)
    {
        echo 'Halo nama saya Sanjaya ' . $nama . ' Saya berumur ' . $umur . ' Tahun';
    }
}
