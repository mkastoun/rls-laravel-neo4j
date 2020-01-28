<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessFolderController extends Controller
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
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(string $accessUuid, string $folderUuid)
    {
        $this->accessLevelService->assignAccessToFolder($accessUuid, $folderUuid);
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
     * return folders without access level assigned
     *
     * @return JsonResponse
     */
    public function folderWithNoAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'folders list without access',
                'data' => $this->accessLevelService->folderWithoutAccess(),
            ]
        );
    }
}
