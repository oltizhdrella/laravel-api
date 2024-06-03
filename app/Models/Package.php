<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Services\PackageService;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['available'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    protected function available(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->checkAvailability();
            }
        );
    }

    public function checkAvailability()
    {
        $logoService = new PackageService($this);
        return $logoService->isAvailable();
    }
}
