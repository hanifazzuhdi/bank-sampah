<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $User = User::all();
        $Order_details = [];
        return view('nasabah.index', compact('User'));
    }
    public function show($id)
    {
        $user = User::where('id', $id);
        if ($user) {
            $user->delete();
            // File::delete(public_path('product/' . $product->image));
            return $this->index()->with(['success' => 'admin dihapus']);
        }
        return $this->sendResponse('Error', 'Gagal menghapus data', null, 500);
    }
    public function trash()
    {
        // mengampil data guru yang sudah dihapus
        $User = User::onlyTrashed()->get();
        return view('nasabah.trash', compact('User'));
    }
    // restore data guru yang dihapus
    public function restore($id)
    {
        $User = User::onlyTrashed()->where('id', $id);
        $User->restore();
        return $this->trash()->with(['success' => 'admin dikembalikan']);
    }
    public function hapus_permanen($id)
    {
        // hapus permanen data guru
        $User = User::onlyTrashed()->where('id', $id);
        $User->forceDelete();
        return $this->trash()->with(['success' => 'admin dikembalikan']);
    }   
}