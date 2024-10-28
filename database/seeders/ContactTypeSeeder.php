<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactType;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
    */
    public function run()
    {
        $contactTypes = [
            ['type' => 'Telefone'],
            ['type' => 'WhatsApp'],
            ['type' => 'Email'],
            ['type' => 'Telegram'],
            ['type' => 'Facebook'],
            ['type' => 'Instagram'],
        ];

        ContactType::insert($contactTypes);
    }
}
