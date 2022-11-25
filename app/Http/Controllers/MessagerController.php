<?php

namespace App\Http\Controllers;

use App\Events\SendMessager;
use App\Models\Messager;
use App\Models\User;
use App\Models\UserRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagerController extends Controller
{
    public function getListFriend()
    {
        $list_friend = UserRelationship::where('user_id', Auth::user()->id)->get();
        $list_user_id = json_decode($list_friend[0]->list_friend_id);

        $data = [];
        foreach ($list_user_id as $key => $value) {
            $data[$key] = [
                'id' => $value,
                'name' => User::find($value)->name
            ];
        }

        return view('messagers.list_friend', compact('data'));
    }

    public function getMessager(int $id_sender, int $id_receiver)
    {
        $arr = [$id_receiver, $id_sender];
        $messagers = Messager::whereIn('id_sender', $arr)
            ->whereIn('id_receiver', $arr)
            ->get();
        $friend_messager= User::find($id_receiver);

        return view('messagers.messager', compact('messagers','id_receiver', 'friend_messager'));
    }

    public function sendMessager (Request $request)
    {
        Messager::create([
            'id_sender' => auth()->user()->id,
            'id_receiver' => (int) $request->id_receiver,
            'content' => $request->content,
        ]);
        event(new SendMessager());

        return redirect()->back();
    }

    public function getRealtimeMessager(int $id_sender, int $id_receiver)
    {
        $arr = [$id_receiver, $id_sender];
        $messagers = Messager::whereIn('id_sender', $arr)
            ->whereIn('id_receiver', $arr)
            ->get();

        return view('messagers.realtime_messager', compact('messagers'));

    }
}
