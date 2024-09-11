<?php

namespace App\Http\Controllers;

use App\Models\Conversas;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    /**
     * Listar todas as amizades do usuário autenticado.
     */
    public function index(Request $request)
    {
        $friendships = Friendship::where('user_id', $request->user()->id)->orWhere('friend_id', $request->user()->id)->where('status', '=', 'accepted')->get() ?? [];
        $friendPending = Friendship::where('friend_id', $request->user()->id)->where('status', '=', 'pending')->get() ?? [];

        return response()->json([
            'friends' => $friendships,
            'pendig' => $friendPending
        ]);
    }

    /**
     * Enviar uma solicitação de amizade.
     */
    public function store(Request $request)
    {
        if ($request->friend_id == $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $exist = Friendship::where('friend_id', $request->user()->id)->where('user_id', $request->friend_id)->where('status', '<>', 'accepted')->first();

        if ($exist !== null) {
            if ($exist->user_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        $request->validate([
            'friend_id' => 'required|exists:users,id',
        ]);

        $username = $request->user()->username;


        $friendship = $request->user()->friendships()->create([
            'friend_id' => $request->friend_id,
            'status' => 'pending',
            'username' => $username,
        ]);

        return response()->json($friendship, 201);
    }


    /**
     * Aceitar uma solicitação de amizade.
     */
    public function update($id)
    {
        $friendship = Friendship::where('user_id', $id)->where('friend_id', auth()->id())->first();
        if ($friendship->user_id != $id || $friendship->friend_id != auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $friendship->update([
            'status' => 'accepted',
        ]);

        Conversas::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $id,
            'message' => "",
        ]);

        return response()->json($friendship);
    }

    /**
     * Deletar uma amizade.
     */
    public function destroy($id)
    {
        $friendship = Friendship::where(function ($query) use ($id) {
            $query->where('user_id', auth()->id())
                ->orWhere('friend_id', auth()->id());
        })->findOrFail($id);

        $friendship->delete();

        return response()->json(null, 204);
    }
}
