<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Belajar Code Igniter'
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl Kecap No 198',
                    'kota' => 'Bandung'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl Pattimura',
                    'kota' => 'Bandung'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}
