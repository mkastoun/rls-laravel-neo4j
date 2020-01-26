<?php

    namespace App\Http\Controllers;

    use App\Http\Services\EmployeeService;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class EmployeeController extends Controller
    {
        protected $employeeService;

        public function __construct(EmployeeService $employeeService)
        {
            $this->employeeService = $employeeService;
        }

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         * @return Response
         */
        public function store(string $teamUuid, Request $request)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Employee stored successfully',
                    'data' => $this->employeeService->createEmployee($request->all(), $teamUuid)->toArray()
                ]);
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         *
         * @return Response
         */
        public function show(string $employeeUuid)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'List of item accessible by employee',
                    'data' => $this->employeeService->getEmployeeAccessibleItem($employeeUuid)
                ]
            );
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

        public function storeOrphanEmployee(Request $request)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Employee stored successfully',
                    'data' => $this->employeeService->createEmployee($request->all(), null, true)->toArray()
                ]);
        }

        public function team(string $employeeUuid)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Employee stored successfully',
                    'data' => $this->employeeService->teamOfEmployee($employeeUuid)
                ]);
        }

        public function access(string $employeeUuid)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Employee stored successfully',
                    'data' => $this->employeeService->employeeAccessLevel($employeeUuid)
                ]);
        }

        public function folders(string $employeeUuid)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Employee stored successfully',
                    'data' => $this->employeeService->getEmployeeAccessibleFolders($employeeUuid)
                ]);
        }

        public function items(string $employeeUuid)
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Employee stored successfully',
                    'data' => $this->employeeService->employeeItems($employeeUuid)
                ]);
        }
    }
