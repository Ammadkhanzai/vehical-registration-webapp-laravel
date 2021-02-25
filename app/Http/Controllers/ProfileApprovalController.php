<?php

namespace App\Http\Controllers;

use App\Profile_approval;
use Illuminate\Http\Request;

class ProfileApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd($request);
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
     * @param  \App\Profile_approval  $profile_approval
     * @return \Illuminate\Http\Response
     */
    public function show(Profile_approval $profile_approval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile_approval  $profile_approval
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile_approval $profile_approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile_approval  $profile_approval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile_approval $profile_approval)
    {
        //
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile_approval  $profile_approval
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile_approval $profile_approval)
    {
        //
    }
}
