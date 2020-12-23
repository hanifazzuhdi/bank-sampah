<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Auth;

class ChatController extends Controller
{
    public function index()
    {
        $my_id = Auth::user()->id;

        $from = User::select('users.id', 'users.name', 'users.image')->distinct()
            ->join('messages', 'users.id', '=', 'messages.to')
            ->where('users.id', '!=', $my_id)
            ->where('messages.from', '=', $my_id)->get()->toArray();

        $to = User::select('users.id', 'users.name', 'users.image')->distinct()
            ->join('messages', 'users.id', '=', 'messages.from')
            ->where('users.id', '!=', $my_id)
            ->where('messages.to', '=', $my_id)->get()->toArray();

        $data = array_unique(array_merge($from, $to), SORT_REGULAR);
        $users = array_values($data);
        return $this->sendResponse('Success', 'kontak dong', $users, 200);

    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // update status terbaca dari user yang mengirim pesan
        Chat::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // ambil pesanya dari user yang di select
        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
           $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return $this->sendResponse('Success', 'ambil pesan', $messages, 200);
    }

    public function sendMessage(Request $request ,$id)
    {
        $from = Auth::id();
        $to = $id;
        $message = $request->message;

        $data = new Chat();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();
        
        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        
        $pusher = new Pusher(
            '714107c06ab063eee783',
            '297099b10e2c437776cb',
            '1116353',
            $options
        );
        
        $pusher->trigger('my-channel', 'my-event', $data);
        return $this->sendResponse('Success', 'kontak dong', $data, 200);
        
        
    }
    public function destroy($id)
    {
        $user = Auth::id();
        $Message = Chat::find($id);
        if ($Message->from != $user) {
            return $this->sendResponse('Success', 'bukan pesan anda', null, 500);
        }
        if ($Message) {
            $Message->delete();
            return $this->sendResponse('Success', 'Berhasil menghapus pesan', $Message, 200);
        }
        return $this->sendResponse('Error', 'Gagal menghapus pesan', null, 500);
    }

}

