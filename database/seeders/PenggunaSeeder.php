<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert(
            [
                [
                    'id_pengguna'   => 'e2de628c-13aa-4d22-a3b4-65868134482b',
                    'username'      => 'admin',
                    'nama'          => 'Admin',
                    'nip'           => '198308242010121005',
                    'email'         => 'admin@pu.go',
                    'password'      => '$2y$10$gasqgqkQJlF21d4HQl3qieHLrdabKR3rBMHLzU5J8S9fXVD7g.Dg2',
                    'role'          => 'Admin',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ],
                [
                    'id_pengguna'   => 'e2de628c-13aa-4d22-a3b4-6586813448bd',
                    'username'      => 'ispamuji',
                    'nama'          => 'Ispamuji',
                    'nip'           => '197004242007011003',
                    'email'         => 'ispamuji@pu.go',
                    'password'      => '$2y$10$gasqgqkQJlF21d4HQl3qieHLrdabKR3rBMHLzU5J8S9fXVD7g.Dg2',
                    'role'          => 'Petugas',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
