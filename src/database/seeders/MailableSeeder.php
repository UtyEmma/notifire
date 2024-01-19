<?php

namespace Utyemma\Notifire;

use App\Services\Mailable\MailableService;
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
            // app(MailableService::class)->generate($key, $value);
        }

    }
}
