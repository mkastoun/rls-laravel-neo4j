<?php

    namespace App\Http\Controllers;

    use App\Http\Services\TeamService;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class TeamController extends Controller
    {
        protected $teamService;

        public function __construct(TeamService $teamService)
        {
            $this->teamService = $teamService;
        }

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index(Request $request)
        {
            return response()->json([
                'success' => true,
                'message' => 'List of teams',
                'data' => $this->teamService->getAllTeams()
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         * @return Response
         */
        public function store(Request $request)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Team stored successfully',
                    'data' => $this->teamService->createTeam($request->all())->toArray()
                ]);
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
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
         * @param Request $request
         * @param int     $id
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
         * @param int $id
         *
         * @return Response
         */
        public function destroy($id)
        {
            //
        }
    }
