<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use App\Http\Services\FolderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FolderController extends Controller
{
    protected $folderService;
    protected $accessLevelService;

    public function __construct(FolderService $folderService, AccessLevelService $accessLevelService)
    {
        $this->folderService = $folderService;
        $this->accessLevelService = $accessLevelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder stored successfully',
                'data' => $this->folderService->folders()->toArray(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Folder stored successfully',
                'data' => $this->folderService->createFolder($request->all())->toArray(),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder Information',
                'data' => $this->folderService->folderDetails($folderUuid),
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
     * Get the folder access folder information
     *
     * @param  string  $folderUuid  folder uuid
     *
     * @return JsonResponse
     */
    public function access(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder access information',
                'data' => $this->accessLevelService->folderAccessLevel($folderUuid),
            ]
        );
    }

    /**
     * Get the folder item list
     *
     * @param  string  $folderUuid  Folder Uuid
     *
     * @return JsonResponse
     */
    public function items(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder items',
                'data' => $this->folderService->items($folderUuid),
            ]
        );
    }
}
