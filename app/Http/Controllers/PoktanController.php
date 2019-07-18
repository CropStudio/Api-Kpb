<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Poktan;

class PoktanController extends Controller
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
        $poktan = Poktan::where('id',$id)->orWhere('nik',$id)->first();
        if($poktan) {
            return response()->json([
                'status' => true,
                'message' => $poktan,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Poktan tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // $validated = $request->validated();
        // return response()->json([$request->name]);
        $poktan = Poktan::find($id);
        $input = $request->all();
        $poktan->fill($input)->save();
        if ($poktan) {
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
        $poktans = Poktan::all();
        if ($poktans) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $poktans
                ], 200);
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Gagal mendapatkan data!',
                ]);
        }
    }

    public function delete($id) {
        $poktan = Poktan::find($id);
        $poktan->delete();
        if($poktan) {
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
        $poktans = DB::table('poktan')->whereIn('id', $request->input('id'))->delete();
        if ( $poktans ) {
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
        $poktan = Poktan::create($data);
        if ( $poktan ) {
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
