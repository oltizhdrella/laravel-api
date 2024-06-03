<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class RegistrationService
{

    protected $package;

    public function __construct($package)
    {
        $this->package = $package;
    }

    public function register()
    {
        $created = Registration::create(['package_id' => $this->package->id, 'customer_id' => Auth::id()]);

        if ($created) {
            return true;
        }
        return false;
    }

}