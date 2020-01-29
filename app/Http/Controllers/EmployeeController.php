<?php

namespace App\Http\Controllers;

use App\Http\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string   $teamUuid  Team Uuid
     * @param  Request  $request   Request that contains data of employee
     *
     * @return JsonResponse
     */
    public function store(string $teamUuid, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Employee stored successfully',
                'data' => $this->employeeService->createEmployee($request->all(), $teamUuid)->toArray(),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $employeeUuid  Employee uuid
     *
     * @return JsonResponse
     */
    public function show(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'List of item accessible by employee',
                'data' => $this->employeeService->getEmployeeAccessibleItem($employeeUuid),
            ]
        );
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
     * Store an employee without team
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function storeOrphanEmployee(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Employee stored successfully without a team',
                'data' => $this->employeeService->createEmployee($request->all(), null, true)->toArray(),
            ]);
    }

    /**
     * get the team of an employee
     *
     * @param  string  $employeeUuid  Employee uuid
     *
     * @return JsonResponse
     */
    public function team(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee team',
                'data' => $this->employeeService->teamOfEmployee($employeeUuid),
            ]);
    }

    /**
     * Get Employee access level
     *
     * @param  string  $employeeUuid  Employee Uuid
     *
     * @return JsonResponse
     */
    public function access(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee access level',
                'data' => $this->employeeService->employeeAccessLevel($employeeUuid),
            ]);
    }

    /**
     * Get employee Accessible folders
     *
     * @param  string  $employeeUuid  Employee Uuid
     *
     * @return JsonResponse
     */
    public function folders(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee Item direct access',
                'data' => $this->employeeService->getEmployeeAccessibleFolders($employeeUuid),
            ]);
    }

    /**
     * Get employee Accessible items
     *
     * @param  string  $employeeUuid  Employee Uuid
     *
     * @return JsonResponse
     */
    public function items(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee item direct access',
                'data' => $this->employeeService->employeeItems($employeeUuid),
            ]);
    }

    /**
     * Get Employee accessible Item through team access level
     *
     * @param  string  $employeeUuid
     *
     * @return JsonResponse
     */
    public function teamItems(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee Team accessible items',
                'data' => $this->employeeService->teamEmployeeItems($employeeUuid),
            ]);
    }

    /**
     * Get Employee accessible folders through team access level
     *
     * @param  string  $employeeUuid
     *
     * @return JsonResponse
     */
    public function folderItems(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee Team accessible items',
                'data' => $this->employeeService->teamEmployeeFolders($employeeUuid),
            ]);
    }

    public function getOrphanEmployee()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee without team',
                'data' => $this->employeeService->getOrphanEmployee(),
            ]);
    }

    public function getEmployeeInfo(string $employeeUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employee without team',
                'data' => $this->employeeService->getEmployee($employeeUuid),
            ]);
    }
}
