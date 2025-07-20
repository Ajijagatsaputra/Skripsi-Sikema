<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Http;

use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nim' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tahun_angkatan' => ['required']
        ]);

        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/mahasiswa', [
            'key' => env('OASE_API_KEY'),
            'nim' => $request->nim,
            'tahun_angkatan' => $request->tahun_angkatan
        ]);

        // dd($response->json());

        if ($response->json()['status'] == false) {
            return back()->withErrors([
                'nim' => 'NIM tidak ditemukan atau mahasiswa belum lulus',
            ]);
        } elseif ($response->json()['data'][0]['status_mahasiswa'] != 'Lulus'){
            return back()->withErrors([
                'nim' => 'Mahasiswa belum lulus',
            ]);
        } else {
            $user = User::create([
                'username' => str_replace(' ', '', strtolower($response->json()['data'][0]['nama_lengkap'])),
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $alumni = Alumni::create([
                'id_users' => $user->id,
                'nim' => $response->json()['data'][0]['nim'],
                'nama_lengkap' => $response->json()['data'][0]['nama_lengkap'],
                'prodi' => $response->json()['data'][0]['prodi']['nama'],
                'kelas' => $response->json()['data'][0]['kelas'],
                'jalur' => $response->json()['data'][0]['jalur'],
                'tahun_masuk' => $response->json()['data'][0]['tahun_masuk'],
                'status_mahasiswa' => $response->json()['data'][0]['status_mahasiswa'],
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('home', absolute: false));
        }

    }
}
