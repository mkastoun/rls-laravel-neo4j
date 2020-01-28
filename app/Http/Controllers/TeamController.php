<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use App\Http\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    protected $teamService;
    protected $accessLevelService;

    public function __construct(TeamService $teamService, AccessLevelService $accessLevelService)
    {
        $this->teamService = $teamService;
        $this->accessLevelService = $accessLevelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'List of teams',
            'data' => $this->teamService->getAllTeams(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Team stored successfully',
                'data' => $this->teamService->createTeam($request->all())->toArray(),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $teamUuid)
    {
        return response()->json([
            'success' => true,
            'message' => 'team details',
            'data' => $this->teamService->teamDetails($teamUuid),
        ]);
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
     * Controller to get list of employees
     *
     * @param  string  $teamUuid  Team Uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function employees(string $teamUuid)
    {
        return response()->json([
            'success' => true,
            'message' => 'List of employees',
            'data' => $this->teamService->teamEmployee($teamUuid),
        ]);
    }

    /**
     * Controller to get list of folders accessible by the team
     *
     * @param  string  $teamUuid  Team Uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function folders(string $teamUuid)
    {
        return response()->json([
            'success' => true,
            'message' => 'List of folders',
            'data' => $this->teamService->getTeamAccessibleFolders($teamUuid),
        ]);
    }

    /**
     * Controller to get list accessible item by the team
     *
     * @param  string  $teamUuid  Team Uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function items(string $teamUuid)
    {
        return response()->json([
            'success' => true,
            'message' => 'List of items',
            'data' => $this->teamService->getTeamAccessibleItems($teamUuid),
        ]);
    }

    /**
     * Return access details of a team
     *
     * @param  string  $teamUuid  Team uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function access(string $teamUuid)
    {
        return response()->json([
            'success' => true,
            'message' => 'Team access level',
            'data' => $this->accessLevelService->teamAccessLevel($teamUuid),
        ]);
    }

    public function detachEmployee(string $teamUuid, string $employeeUuid)
    {
        $this->teamService->unassignEmployee($teamUuid, $employeeUuid);
        return response()->json([
            'success' => true,
            'message' => 'Team employee removed',
            'data' => [],
        ]);
    }

    public function addOrphanEmployeeToTeam($teamUuid, $employeeUuid)
    {
        $this->teamService->assignEmployeeToTeam($teamUuid, $employeeUuid);
        return response()->json([
            'success' => true,
            'message' => 'Employee added to team successfully',
            'data' => [],
        ]);
    }

}
