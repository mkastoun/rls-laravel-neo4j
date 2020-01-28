<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessTeamController extends Controller
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
    public function store(string $accessUuid, string $teamUuid)
    {
        $this->accessLevelService->assignAccessToTeam($accessUuid, $teamUuid);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $teamUuid  Team Uuid
     *
     * @return Response
     */
    public function show(string $teamUuid)
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
     * return teams without access level assigned
     *
     * @return JsonResponse
     */
    public function teamWithNoAccess()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'Teams list without access',
                'data' => $this->accessLevelService->teamWithoutAccess(),
            ]
        );
    }

    public function revokeTeamAccess(string $accessUuid, string $teamUuid)
    {
        $this->accessLevelService->revokeTeamAccess($accessUuid, $teamUuid);
        return response()->json(
            [
                'success' => true,
                'message' => 'Team Access revoked',
                'data' => [],
            ]
        );
    }

}
