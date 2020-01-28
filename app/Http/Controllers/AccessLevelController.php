<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use Illuminate\Http\Request;

class AccessLevelController extends Controller
{
    protected $accessLevelService;

    public function __construct(AccessLevelService $accessLevelService)
    {
        $this->accessLevelService = $accessLevelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Access level list',
                'data' => $this->accessLevelService->access()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Access level created successfully',
                'data' => $this->accessLevelService->createAccessLevel($request->all())->toArray()
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $accessUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Access level details',
                'data' => $this->accessLevelService->accessDetails($accessUuid)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function employeeWithoutAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Employees list without access',
                'data' => $this->accessLevelService->employeeWithoutAccess()
            ]
        );
    }

    public function teamWithNoAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Teams list without access',
                'data' => $this->accessLevelService->teamWithoutAccess()
            ]
        );
    }

    public function folderWithNoAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'folders list without access',
                'data' => $this->accessLevelService->folderWithoutAccess()
            ]
        );
    }

    public function itemWithNoAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'items list without access',
                'data' => $this->accessLevelService->itemWithoutAccess()
            ]
        );
    }
}
