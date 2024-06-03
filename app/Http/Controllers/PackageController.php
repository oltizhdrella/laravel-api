<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use App\Services\RegistrationService;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/package/list/all",
     *     tags={"Package"},
     *     summary="Show all packages",
     *     @OA\Response(response="201", description="Successful operation"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="401", description="Unauthenticated"),
     *     @OA\Response(response="403", description="Forbidden"),
     *    security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function list()
    {
        return response()->json(Package::all());
    }

    /**
     *
     * @OA\Post(
     *     path="/api/package/{package}/register",
     *     tags={"Package"},
     *     summary="Register package",
     *     @OA\Response(response="201", description="Successful operation"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="401", description="Unauthenticated"),
     *     @OA\Response(response="403", description="Forbidden"),
     * 
     *     @OA\Parameter(
     *     name="package",
     *     description="Package ID",
     *     required=true,
     *     in="path",
     *      @OA\Schema(
     *           type="integer"
     *       )
     *      ),
     *     
     *    security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function registerPackage($packageId)
    {
        $package = Package::findorfail($packageId);
        $registrationService = new RegistrationService($package);

        if($package->available == true){
            if($registrationService->register())
            {
                return response()->json(['success' => true, 'code' => 201]);
            }
            return response()->json(['success' => false, 'code' => 422]);
        }else{
            return response()->json(['success' => false, 'code' => 422, 'message' => 'Package is not available']);
        }
    }

}
