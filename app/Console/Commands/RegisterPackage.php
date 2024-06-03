<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use App\Models\Package;
use App\Models\User;

class RegisterPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:package {user_id} {package_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a specific package to a user';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $packageId = $this->argument('package_id');

        $package = Package::find($packageId);
        $user = User::find($userId);

        if (!$package) {
            $this->error('Package not found.');
            return 1; 
        }

        if (!$user) {
            $this->error('User not found.');
            return 1; 
        }

        if (!$package->available) {
            $this->error('The package is not available.');
            return 1; 
        }

        Registration::create(['customer_id' => $userId, 'package_id' => $packageId]);

        $this->info('Package registration successful.');
        return 0; 
    }
}
