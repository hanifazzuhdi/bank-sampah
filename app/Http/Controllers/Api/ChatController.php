<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use Pusher\Pusher;
use App\Model\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index()
    {
        $my_id = Auth::user()->id;

        $from = User::select('users.id', 'users.name', 'users.avatar')->distinct()
            ->join('chats', 'users.id', '=', 'chats.to')
            ->where('users.id', '!=', $my_id)
            ->where('chats.from', '=', $my_id)->get()->toArray();

        $to = User::select('users.id', 'users.name', 'users.avatar')->distinct()
            ->join('chats', 'users.id', '=', 'chats.from')
            ->where('users.id', '!=', $my_id)
            ->where('chats.to', '=', $my_id)->get()->toArray();

        $data = array_unique(array_merge($from, $to), SORT_REGULAR);
        $users = array_values($data);
        return $this->sendResponse('Success', 'kontak dong', $users, 200);
    }

    public function getChat($user_id)
    {
        $my_id = Auth::id();

        // update status terbaca dari user yang mengirim pesan
        Chat::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // ambil pesanya dari user yang di select
        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id)->where('owner', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id)->where('owner', $my_id);
        })->orderBy('created_at','ASC')->get();

        return $this->sendResponse('Success', 'ambil pesan', $messages, 200);
    }

    public function sendChat(Request $request, $id)
    {
        $from = Auth::id();
        $to = $id;
        $message = $request->message;

        $data = new Chat();
        $data->from = $from;
        $data->to = $to;
        $data->owner = $from;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        $data = new Chat();
        $data->from = $from;
        $data->to = $to;
        $data->owner = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            '7c4e768837de4f546c9b',
            'dd36d2b0ef5e33c5ec2d',
            '1127854',
            $options
        );

        $pusher->trigger('my-channel', 'my-event', $data);
        return $this->sendResponse('Success', 'pesan terkirim bos', $data, 200);
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

    public function hapus_untuk_semua($id)
    {
        //masih butuh banyak seklai penelitian bos
        //cacatnya masih ada
        $user = Auth::id();
        $Message = Chat::find($id);
        $semua = Chat::where('message', $Message->message)->where('created_at', $Message->creted_at)->where('id', $id + 1);
        if ($Message->from != $user) {
            return $this->sendResponse('Success', 'bukan pesan anda', null, 500);
        }
        if ($Message->is_read = 0) {
            $Message->delete();
            $semua->delete();
            return $this->sendResponse('Success', 'Berhasil menghapus pesan', $Message, 200);
        } else {
            return $this->sendResponse('Error', 'pesan anda sudah dibaca', null, 500);
        }
    }
}
