<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
//        $this->middleware('auth');
    }

    public function show($id) {
        $user = User::where('id',$id)->orWhere('nik',$id)->first();
        if($user) {
            return response()->json([
                'status' => true,
                'message' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // $validated = $request->validated();
        // return response()->json([$request->name]);
        $user = User::find($id);
        $input = $request->all();
        if($request->has('password')) {
            $password = Hash::make($request->password);
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password tidak boleh sama seperti sebelumnya!'
                ]);
            } else {
                $input['password'] = $password;
            }
        }
        $user->fill($input)->save();
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil update!',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal update!',
            ]);
        }
    }
    public function index() {
        $users = User::all();
        if ($users) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $users
                ], 200);
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Gagal mendapatkan data!',
                ]);
        }
    }

    public function profile () {
        $user = \Auth::user();
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data!'
            ]);
        }
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        if($user) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data!'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data'
            ], 200);
        }
    }
    public function massdelete(Request $request) {
        $users = DB::table('users')->whereIn('id', $request->input('id'))->delete();
        if ( $users ) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data!'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data!'
            ], 200);
        }
    }

    public function insert (Request $request) {
        $data = $request->all();
        $password = Hash::make($request->password);
        $data['password'] = $password;
        $user = User::create($data);
        if ( $user ) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menambah data!'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambah data!'
            ], 200);
        }
    }
}
