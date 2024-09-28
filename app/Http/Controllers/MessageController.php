<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
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
    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $msg = Message::create([
            "user_id" => $userId,
            "conversa_id" => $request->conversaId,
            "mensagem" => $request->mensagem,
        ]);


        event(new SendMessage($request->friendId));
        return response()->json($msg);
    }


    public function show($id)
    {
        $messages = Message::where("conversa_id", $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return $messages;
    }

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