<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Temp;
use App\Models\User;
use Twilio\Rest\Client;
use App\Models\UsersTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\WhatsappApiServices;

class AuthController extends Controller
{
    protected $whatsappApiServices;

    public function __construct(WhatsappApiServices $whatsappApiServices)
    {
        $this->whatsappApiServices = $whatsappApiServices;
    }

    protected function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $otp = rand(1000, 9999);
        $user_temp = Temp::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => Hash::make($data['password']),
                'otp' => $otp,
        ]);
        // $user = User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'phone_number' => $data['phone_number'],
        //     'password' => Hash::make($data['password']),
        //     'otp' => $otp,
        // ]);
        // $role = Role::where('name', 'warga')->first();
        // $user->attachRole($role);

        $body = 'Sistem Informasi RT - OTP ini digunakan untuk verifikasi akun. JANGAN BAGIKAN OTP INI KE SIAPAPUN. OTP:'. $user_temp->otp;

        $response = $this->whatsappApiServices->sendMessage($user_temp->phone_number, $body);
        // dd($user->phone_number);
        return redirect()->route('verify')->with(['phone_number' => $user_temp['phone_number']]);
    }

    protected function resend(Request $request)
    {
        $data = $request->validate([
            'phone_number' => ['required', 'string'],
        ]);
        $user_temp = Temp::where('phone_number', $data['phone_number'])->first();

        $otp = rand(1000, 9999);

        $user_temp->update([
            'otp' => $otp
        ]);

        $body = 'Sistem Informasi RT - OTP ini digunakan untuk verifikasi akun. JANGAN BAGIKAN OTP INI KE SIAPAPUN. OTP:'. $user_temp->otp;

        $response = $this->whatsappApiServices->sendMessage($user_temp->phone_number, $body);
        // dd($user->phone_number);
        return redirect()->route('verify')->with(['phone_number' => $user_temp['phone_number']]);
    }

    protected function verify(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'otp' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);

        $user_temp = Temp::orderBy('id', 'DESC')->where('phone_number', $data['phone_number'])->first();
        // var_dump($user_temp);
        if ($user_temp->otp == $data['otp']) {

            $user = User::create([
                    'name' => $user_temp['name'],
                    'email' => $user_temp['email'],
                    'phone_number' => $user_temp['phone_number'],
                    'password' => $user_temp['password'],
                    'otp' => $user_temp['otp'],
                    'isVerified' => false
                ]);
            $role = Role::where('name', 'warga')->first();
            $user->attachRole($role);
            Auth::login($user);

            $user_temp->delete();
            return redirect()->route('user.dashboard')->withToastSuccess('Nomor telepon terverifikasi');
        }
        return back()->with(['phone_number' => $request->phone_number, 'verification_code' => $request->verification_code])->withToastError('Kode verifikasi salah!');
    }

}
