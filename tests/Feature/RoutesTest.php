<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use App\Models\Package;
use App\Services\RegistrationService;


class RoutesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_returns_error_for_nonexistent_package()
    {
        $nonExistentPackageId = 999;

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $registrationService = new RegistrationService($nonExistentPackageId);
        $registrationService->register();
    }

}
