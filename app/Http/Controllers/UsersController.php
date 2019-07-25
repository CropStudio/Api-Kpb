<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Petani;

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
        $user = User::gabung()->where('id',$id)->orWhere('nik',$id)->first();
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
//        $users = User::all();
        $users = User::gabung()->get();
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

    public function registerPetani(Request $request)
    {
        $nik       = $request->input('nik');
        $nama      = $request->input('nama');
        $notelp    = $request->input('notelp');
        $password  = Hash::make($request->input('password'));
        $roles     = $request->input('role');
        $imageKtp  = $request->file('fotoktp');
        $image     = $request->file('fotokk');

        $cekNik = User::where('nik',$nik)->first();

        if($cekNik){
            $res['status'] = false;
            $res['message'] = 'Nik anda sudah teregistrasi';
            return response($res);
        }else{
            //move ktp
            $fotoKtp            = "ktp".time().'.'.$imageKtp->getClientOriginalExtension();
            $destinationPathKtp = 'ktp';
            $imageKtp->move($destinationPathKtp, $fotoKtp);
            //move ktp
            $fotokk             = "kk".time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = 'kk';
            $image->move($destinationPath, $fotokk);
            $register = User::create([
                'nik'           => $nik,
                'nama'          => $nama,
                'no_hp'         => $notelp,
                'role'          => $roles,
                'password'      => $password,
                'ktp'           => $fotoKtp,
                'kartukeluarga' => $fotokk,
            ]);
            if ($register){
                $res['status'] = true;
                $res['message'] = 'Berhasil registrasi';
                return response($res,200);
            }else{
                $res['status'] = false;
                $res['message'] = 'Gagal registrasi!';
                return response($res);
            }
        }
    }

    public function uploadPotopropil(Request $request, $id){
        $user = User::find($id);
        $input = $request->all();
        if ($request->hasFile('poto_profile')) {
            $image = $request->file('poto_profile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'potopropil';
            $image->move($destinationPath, $name);

            $input['poto_profile'] = $name;
            //dd($input);
            $user->fill($input)->save();
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil update foto!',
                    'foto'    => $user->poto_profile
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal update!',
                ]);
            }
        } else {
            return 0;
        }
    }

    public function loginPetani(Request $request){
        $nik = $request->input('nik');
        $password = $request->input('password');
        $login = User::where('nik', $nik)->first();
        if (!$login) {
            $res['status'] = false;
            $res['message'] = 'Nik tidak terdaftar!';
            return response($res);
        }else{
            if (Hash::check($password, $login->password)) {
                $api_token    = sha1(time());
                $create_token = User::where('id', $login->id)->update(['token' => $api_token]);
                Petani::where('nik', $login->nik)->update(['id_user' => $login->id]);
                if ($create_token) {
                    $res['status'] = true;
                    $res['token'] = $api_token;
                    $res['message'] = $login;
                    return response($res);
                }
            }else{
                $res['status'] = false;
                $res['message'] = 'Periksa kembali email atau password anda';
                return response()->json($res);
            }
        }
    }
}
