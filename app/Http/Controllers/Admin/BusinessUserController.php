<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrgUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  OrgUser  $orgUser
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, OrgUser $orgUser)
    {
        abort_if(Gate::denies('business_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orgUser->update([
            'approved' => (int) $request->input('active', 0)
        ]);

        $action = $request->input('active', 0) == 1 ? 'activated' : 'deactivated';

        return back()->with('success', sprintf('User was %s successfully', $action));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  OrgUser  $orgUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrgUser $orgUser)
    {
        abort_if(Gate::denies('business_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orgUser->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
