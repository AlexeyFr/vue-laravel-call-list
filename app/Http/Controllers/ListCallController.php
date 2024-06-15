<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ListCall;
use Illuminate\Http\Request;

class ListCallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ListCall = ListCall::orderBy('name')->get();
        if($request->ajax()) {
            return $ListCall;
        }
        else {
            return view('dashboard', compact('ListCall'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $newPhone = new ListCall($request->all());
            $newPhone->user_id = Auth::user()->id;
            $newPhone->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ListCall $listCall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListCall $listCall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListCall $listCall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListCall $listCall)
    {
        //
    }
}
