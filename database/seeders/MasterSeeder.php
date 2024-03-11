<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            'role' => 'Pelapor',
            'created_at' => now()
        ]);
        DB::table('user_roles')->insert([
            'role' => 'Admin',
            'created_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Pelapor 1',
            'nik' => '1234567890123456',
            'phone_number' => '08123456789',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'id_user_role' => 1,
            'created_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Admin 1',
            'nik' => '1234567896',
            'phone_number' => '08123789',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'id_user_role' => 2,
            'created_at' => now()
        ]);
        DB::table('laporan_status')->insert([
            'status' => 'Pending',
            'created_at' => now()
        ]);
        DB::table('laporan_status')->insert([
            'status' => 'Proses',
            'created_at' => now()
        ]);
        DB::table('laporan_status')->insert([
            'status' => 'Selesai',
            'created_at' => now()
        ]);
    }
}
