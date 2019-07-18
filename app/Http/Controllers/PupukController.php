<?php

namespace App\Http\Controllers;
use App\Pupuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PupukController extends Controller
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
        $pupuk = Pupuk::where('id',$id)->first();
        if($pupuk) {
            return response()->json([
                'status' => true,
                'message' => $pupuk,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pupuk tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // $validated = $request->validated();
        // return response()->json([$request->name]);
        $pupuk = Pupuk::find($id);
        $input = $request->all();
        $pupuk->fill($input)->save();
        if ($pupuk) {
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
        $pupuks = Pupuk::all();
        if ($pupuks) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $pupuks
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
        $pupuk = Pupuk::find($id);
        $pupuk->delete();
        if($pupuk) {
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
        $pupuks = DB::table('pupuk')->whereIn('id', $request->input('id'))->delete();
        if ( $pupuks ) {
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
        $pupuk = Pupuk::create($data);
        if ( $pupuk ) {
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
