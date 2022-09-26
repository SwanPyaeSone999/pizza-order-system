<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--name=} {--email=} {--password=?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin..';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::create([
            'name' => $this->option('name'),
            'email' => $this->option('email'),
            'image' => '',
            'phone' => '09877545',
            'address' => 'Ygn',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' =>  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);
        $this->info('Successfully Created');
    }
}
