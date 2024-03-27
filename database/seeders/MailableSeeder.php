<?php

namespace Utyemma\Notifire\Database\Seeders;

use Illuminate\Database\Seeder;

class MailableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = config('notifire::mailables');

        foreach ($messages as $key => $value) {
        }

    }
}
