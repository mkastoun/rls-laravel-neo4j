<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessEmployeeController extends Controller
{
    protected $accessLevelService;

    public function __construct(AccessLevelService $accessLevelService)
    {
        $this->accessLevelService = $accessLevelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $accessUuid
     * @param  string  $employeeUuid
     *
     * @return void
     */
    public function store(string $accessUuid, string $employeeUuid)
    {
        $this->accessLevelService->assignAccessToEmployee($accessUuid, $employeeUuid);
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee Access assigned',
                'data' => [],
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * return employees without access level assigned
     *
     * @return JsonResponse
     */
    public function employeeWithoutAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employees list without access',
                'data' => $this->accessLevelService->employeeWithoutAccess(),
            ]
        );
    }

    /**
     * Revoke employee access
     *
     * @return JsonResponse
     */
    public function revokeEmployeeAccess(string $accessUuid, string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Revoke employee access',
                'data' => $this->accessLevelService->revokeEmployeeAccess($accessUuid, $employeeUuid),
            ]
        );
    }
}
