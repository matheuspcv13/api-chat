<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversasRequest;
use App\Http\Requests\UpdateConversasRequest;
use App\Models\Conversas;
use App\Models\User;
use Illuminate\Http\Request;

class ConversasController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->user()->id;
        $conversas = Conversas::where('sender_id', $id)->orWhere('receiver_id', $id)->get() ?? [];
        foreach ($conversas as $conv) {
            if ($conv['receiver_id'] == $id) {
                $user = User::where('id', $conv['sender_id'])->first();
            } else {
                $user = User::where('id', $conv['receiver_id'])->first();
            };
            $conv['name'] = $user['username'];
        }
        return response()->json($conversas);
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
    public function store(StoreConversasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversas $conversas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversas $conversas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConversasRequest $request, Conversas $conversas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversas $conversas)
    {
        //
    }
}
