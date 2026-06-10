<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'nama' => 'HP Victus 16',
                'harga'  => 22000000,
                'jumlah' => 5,
                'foto' => 'mypictusgweh.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'Advan Workplus R7',
                'harga'  => 8200000,
                'jumlah' => 7,
                'foto' => 'mywokplusgweh.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'MacBook pro M5',
                'harga'  => 30000000,
                'jumlah' => 5,
                'foto' => 'mcbook.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'LOQ',
                'harga'  => 12000000,
                'jumlah' => 5,
                'foto' => 'LOQ.jpg',
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('product')->insert($item);
        }
    }
}