<?php

namespace App\Services;

class PackageService
{

    protected $package;

    public function __construct($package)
    {
        $this->package = $package;
    }

    public function isAvailable()
    {
        $limit = $this->package->limit;
        $registrationCount = $this->package->registrations()->count();

        if ($registrationCount >= $limit) {
            return false;
        }
        return true;
    }

}