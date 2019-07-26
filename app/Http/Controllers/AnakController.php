<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Anak;
use Carbon\Carbon;

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
        $anak = Anak::where('id',$id)->with('user')->first();
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
        $anaks = Anak::with('user')->get();
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
            ->select('petani.nik', 'anak.id','anak.nama','anak.jenis_kelamin','anak.tanggal_lahir')
            ->join('anak','petani.id_user','=','anak.id_user')
            ->join('users','users.id','=','petani.id_user')
            ->where('users.id' ,'=' ,$id)
            ->get();
        if(!$anak->isEmpty()) {
            //$convert = substr($anak->tanggal_lahir,4);
            foreach ($anak as $tahun){
                $convert = substr($tahun->tanggal_lahir,0, 4);
                $umur = Carbon::now()->year - $convert;
                $tahun->umur = $umur;
            }
            return response()->json([
                'status'  => true,
                'message' => $anak
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
        }
    }
}
