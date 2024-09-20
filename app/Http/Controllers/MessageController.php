<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $friendId = $request->input("friendId");

        $conversationController = new ConversasController();
        $conversation = $conversationController->show($request->user()->id, $friendId);


        $message = array(
            "id_conversa" => $conversation->id,
            "user" => Message::where("user_id", $request->user()->id)->get(),
            "friend" => Message::where("user_id", $friendId)->get()
        );

        return response()->json($message);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
