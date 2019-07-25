<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Jatah;

class JatahController extends Controller
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
        $jatah = Jatah::gabung()->where('jatah.id',$id)->first();
        if($jatah) {
            return response()->json([
                'status' => true,
                'message' => $jatah,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Jatah tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // $validated = $request->validated();
        // return response()->json([$request->name]);
        $jatah = Jatah::find($id);
        $input = $request->all();
        $jatah->fill($input)->save();
        if ($jatah) {
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
//        $jatahs = Jatah::all();
        $jatahs = Jatah::gabung()->get();
        if ($jatahs) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $jatahs
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
        $jatah = Jatah::find($id);
        $jatah->delete();
        if($jatah) {
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
        $jatahs = DB::table('jatah')->whereIn('id', $request->input('id'))->delete();
        if ( $jatahs ) {
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
        $jatah = Jatah::create($data);
        if ( $jatah ) {
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
