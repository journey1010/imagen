<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offices;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $offices = json_decode(file_get_contents(storage_path('app/offices_202412020819.json')), true);

        foreach($offices as $item){
            Offices::create([
                'name' => $item['name'],
                'init' => $item['sigla']
            ]);
        }

        User::create([
            'name' => 'Lucius',
            'email' => 'lucius-artorius@gmail.com',
            'password' => Hash::make('Hola5.2')
        ]);
    }
}