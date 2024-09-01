<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PassportInstall extends Seeder
{
    public function run()
    {
        Artisan::call('passport:client', ['--personal' => true, '--name' => 'Personal Access Client']);
    }
}
