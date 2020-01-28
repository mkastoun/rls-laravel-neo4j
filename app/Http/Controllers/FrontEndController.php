<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessLevelService;
use App\Http\Services\TeamService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FrontEndController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.employee');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.team');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
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
     * @param  int  $id
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
     * @param  int  $id
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
     * render team details view
     *
     * @return Factory|View
     */
    public function teamDetails()
    {
        return view('admin.team-details');
    }

    /**
     * render employee details view
     *
     * @return Factory|View
     */
    public function employeeDetails()
    {
        return view('admin.employee-details');
    }

    /**
     * render folder view
     *
     * @return Factory|View
     */
    public function folder()
    {
        return view('admin.folder');
    }

    /**
     * render folder details view
     *
     * @return Factory|View
     */
    public function folderDetails()
    {
        return view('admin.folder-details');
    }

    /**
     * render access view
     *
     * @return Factory|View
     */
    public function access()
    {
        return view('admin.access');
    }

    /**
     * render access details view
     *
     * @return Factory|View
     */
    public function accessDetails()
    {
        return view('admin.access-details');
    }
}
