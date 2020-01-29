<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Access level list',
                'data' => $this->accessLevelService->access(),
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
            'level' => 'required|number',
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Access level created successfully',
                'data' => $this->accessLevelService->createAccessLevel($request->all())->toArray(),
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
    public function show(string $accessUuid)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Access level details',
                'data' => $this->accessLevelService->accessDetails($accessUuid),
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
}
