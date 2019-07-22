<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Petani;

class PetaniController extends Controller
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

        $petani = DB::table('petani')
            ->select('petani.id','petani.nik','petani.nama','petani.jenis_kelamin','petani.komoditas','petani.jenis_kelamin',
                              'petani.luas_lahan', 'poktan.nama as nama_poktan', 'poktan.id as id_poktan', 'poktan.kabupaten',
                'poktan.kecamatan', 'poktan.desa')
            ->leftJoin('poktan','petani.id_poktan','=','poktan.id')
            ->where('petani.nik' ,'=' ,$id)
            ->first();
        if($petani) {
            return response()->json([
                'status' => true,
                'message' => $petani,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Petani tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // $validated = $request->validated();
        // return response()->json([$request->name]);
        $petani = Petani::find($id);
        $input = $request->all();
        $petani->fill($input)->save();
        if ($petani) {
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
//        $petanis = Petani::all();
        $petanis = DB::table('petani')
            ->join('poktan', 'petani.id_poktan', '=', 'poktan.id')
            ->select('*', 'poktan.nama as nama_poktan')
            ->get();
        if ($petanis) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $petanis
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
        $petani = Petani::find($id);
        $petani->delete();
        if($petani) {
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
        $petanis = DB::table('petani')->whereIn('id', $request->input('id'))->delete();
        if ( $petanis ) {
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
        $petani = Petani::create($data);
        if ( $petani ) {
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
