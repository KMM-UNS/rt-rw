<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\WhatsappApiServices;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $otp = rand(0000, 9999);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'otp' => $otp,
        ]);
        $role = Role::where('name', 'warga')->first();
        $user->attachRole($role);

        $body = 'Sistem Informasi RT - OTP ini digunakan untuk verifikasi akun. JANGAN BAGIKAN OTP INI KE SIAPAPUN. OTP:'. $user->otp;

        $response = $this->whatsappApiServices->sendMessage($user->phone_number, $body);
        // dd($user->phone_number);
        return redirect()->route('verify')->with(['phone_number' => $data['phone_number']]);
    }

    protected function verify(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'otp' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);

        $user = User::where('phone_number', $data['phone_number'])->first();
        if ($user->otp == $data['otp']) {
            $user->update(['isVerified' => true]);
            Auth::login($user);
            return redirect()->route('user.dashboard')->withToastSuccess('Nomor telepon terverifikasi');
        }
        return back()->with(['phone_number' => $request->phone_number, 'verification_code' => $request->verification_code])->withToastError('Kode verifikasi salah!');
    }

}
