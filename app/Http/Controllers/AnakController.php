<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Anak;

class AnakController extends Controller
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
        $anak = Anak::where('id',$id)->first();
        if($anak) {
            return response()->json([
                'status' => true,
                'message' => $anak,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Anak tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // $validated = $request->validated();
        // return response()->json([$request->name]);
        $anak = Anak::find($id);
        $input = $request->all();
        $anak->fill($input)->save();
        if ($anak) {
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
        $anaks = Anak::all();
        if ($anaks) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $anaks
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
        $anak = Anak::find($id);
        $anak->delete();
        if($anak) {
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
        $anaks = DB::table('anak')->whereIn('id', $request->input('id'))->delete();
        if ( $anaks ) {
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
        $anak = Anak::create($data);
        if ( $anak ) {
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

    public function cekAnak($id){
        $anak = DB::table('petani')
            ->select('petani.nik','petani.nama','anak.nama','anak.tanggal_lahir','anak.jenis_kelamin')
            ->join('anak','petani.id','=','anak.id_user')
            ->where('petani.id' ,'=' ,$id)
            ->get();
        if(!$anak->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => $anak,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
        }
    }
}
