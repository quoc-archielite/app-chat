<?php

namespace Database\Seeders;

use App\Models\Messager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Messager::truncate();

        $data_messagers = [
            'Hello Sang, good morning !',
            'What your name ?',
            'How are you ?',
            'My name is Sang.',
            'Im fine. And you ?'
        ];

        foreach ($data_messagers as $key => $value) {
            Messager::create([
                'id_sender' => rand(1,2),
                'id_receiver' => rand(1,2),
                'content' => $value
            ]);
        }
    }
}
