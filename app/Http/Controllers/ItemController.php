<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use App\Http\Services\ItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    protected $itemService;
    protected $accessLevelService;

    public function __construct(ItemService $itemService, AccessLevelService $accessLevelService)
    {
        $this->itemService = $itemService;
        $this->accessLevelService = $accessLevelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(string $folderUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Item list in folder',
                'data' => $this->itemService->getFolderItems($folderUuid),
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
    public function store(string $folderUuid, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Item stored successfully',
                'data' => $this->itemService->createItem($request->all(), $folderUuid)->toArray(),
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
    public function show(string $folderUuid, string $itemUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Item details',
                'data' => $this->itemService->itemDetails($itemUuid),
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

    public function access(string $folderUuid, string $itemUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Folder access information',
                'data' => $this->accessLevelService->itemAccessLevel($itemUuid),
            ]
        );
    }
}
