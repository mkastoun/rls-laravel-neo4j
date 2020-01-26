<?php

    namespace App\Http\Controllers;

    use App\Http\Services\TeamService;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class FrontEndController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            return view('admin.employee');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            return view('admin.team');
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
            //
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
         * Show the form for editing the specified resource.
         *
         * @param int $id
         *
         * @return Response
         */
        public function edit($id)
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

        public function teamDetails()
        {
            return view('admin.team-details');
        }

        public function employeeDetails()
        {
            return view('admin.employee-details');
        }

        public function folder()
        {
            return view('admin.folder');
        }

        public function folderDetails()
        {
            return view('admin.folder-details');
        }
    }
