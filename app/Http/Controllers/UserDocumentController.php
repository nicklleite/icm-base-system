<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserDocumentRequest;
use App\Http\Requests\UpdateUserDocumentRequest;
use App\Models\UserDocument;

class UserDocumentController extends Controller
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
     * @param  \App\Http\Requests\StoreUserDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function show(UserDocument $userDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDocument $userDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserDocumentRequest  $request
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserDocumentRequest $request, UserDocument $userDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDocument $userDocument)
    {
        //
    }
}
