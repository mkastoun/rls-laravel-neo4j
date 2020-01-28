<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessItemController extends Controller
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
    public function store(string $accessUuid, string $itemUuid)
    {
        $this->accessLevelService->assignAccessToItem($accessUuid, $itemUuid);
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
     * return items without access level assigned
     *
     * @return JsonResponse
     */
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
