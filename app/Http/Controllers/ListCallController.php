<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ListCall;
use Illuminate\Http\Request;
use Exception;

class ListCallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $listCalls = Auth::user()->hasCalls;
            if($request->ajax()) {
                return $listCalls;
            }
            else {
                return view('dashboard', compact('listCalls'));
            }
        }
        else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $itemCall = new ListCall($request->all());
            $itemCall->user_id = Auth::user()->id;
            $itemCall->save();
        }
        else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $itemCall = ListCall::findOrFail($id);
        }
        catch(Exception $exception){
            return response()->json($exception->getMessage(), 404);
        }
        if (Auth::check() && Auth::id() == $itemCall->user_id) {
            $itemCall->update($request->all());
        }
        else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $itemCall = ListCall::findOrFail($id);
        }
        catch(Exception $exception){
            return response()->json($exception->getMessage(), 404);
        }
        if (Auth::check() && Auth::id() == $itemCall->user_id) {
            $itemCall->delete($id);
        }
        else {
            abort(403);
        }
    }
}
