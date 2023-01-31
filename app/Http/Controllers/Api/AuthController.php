<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_member' => 'required|unique:member|max:255',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'nomor_handphone' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        unset($data['konfirmasi_password']);

        $member = Member::create($data);

        return response()->json([
            'data' => $member,
        ], 200);
    }

    public function login_member()
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $member = Member::where('email', $request->email)->first();

        if ($member) {
            if (Hash::check($request->password, $member->password)) {
                $request->session()->regenerate();
                return response()->json([
                    'message' => 'success',
                    'data' => $member,
                ], 200);
            }
            else {
                return response()->json([
                'message' => 'fail',
                'data' => 'Password is wrong',
            ]);
            }
        }
        else {
            return response()->json([
                'message' => 'fail',
                'data' => 'Email is wrong',
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully Logout',
        ]);
    }

    public function logout_member()
    {
        Session::flush();

        return redirect('/login');
    }

}
