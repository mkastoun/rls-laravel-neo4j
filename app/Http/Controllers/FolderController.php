<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use App\Http\Services\FolderService;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder stored successfully',
                'data' => $this->folderService->folders()->toArray()
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
                'message' => 'Folder stored successfully',
                'data' => $this->folderService->createFolder($request->all())->toArray()
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder Information',
                'data' => $this->folderService->folderDetails($folderUuid)
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

    public function access(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder access information',
                'data' => $this->accessLevelService->folderAccessLevel($folderUuid)
            ]
        );
    }

    public function items(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder items',
                'data' => $this->folderService->items($folderUuid)
            ]
        );
    }
}
