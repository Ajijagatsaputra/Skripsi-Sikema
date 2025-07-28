<?php

use App\Http\Controllers\AdminTracerController;
use App\Http\Controllers\ProfileAlumniController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HasilTracerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuesionerAlumni;
use App\Http\Controllers\KuesionerAlumniController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TracerAlumniController;
use App\Http\Controllers\TracerStudyController;
use App\Models\TracerStudy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileAdminController;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Auth
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Register (umum)
Route::get('/register', fn() => view('register'))->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Admin-only routes
Route::middleware(['auth', 'cekrole:admin,superadmin'])->group(function () {
    Route::get('/admin', function () {
        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/mahasiswa', [
            'key' => env('OASE_API_KEY'),
            'tahun_angkatan' => '2021'
        ]);
        $count = count($response->json()['data']);
        return view('admin.admin-dashboard', compact('count'));
    })->name('admin.dashboard');


    Route::get('/profileadmin/index', [ProfileAdminController::class, 'show'])->name('profileadmin.index');
    Route::put('/profileadmin/update', [ProfileAdminController::class, 'update'])->name('profileadmin.update');
    Route::put('/profileadmin/password', [ProfileAdminController::class, 'updatePassword'])->name('profileadmin.update-password');

    Route::get('/listmahasiswa', fn() => view('mahasiswa.table-mahasiswa'));
    Route::get('/listdosen', fn() => view('dosen.table-dosen'));
    Route::get('/listalumni', fn() => view('alumni.table-alumni'));
    // Route::get('/listhasiltracer', fn() => view('tracer.hasil'));
    Route::get('/listhasiltracer', [HasilTracerController::class, 'index'])->name('tracer.rekap');

    // Route::get('/listtraceralumni', [TracerAlumniController::class, 'index'])->name('tracer.index');
    Route::get('/api/mahasiswa', [MahasiswaController::class, 'getData'])->name('api.mahasiswa');
    Route::get('/api/alumni', [TracerAlumniController::class, 'getData'])->name('api.alumni');
    Route::get('/api/dosen', [DosenController::class, 'getDataDosen'])->name('api.dosen');
    Route::get('/api/tahun-akademik', [DosenController::class, 'getTahunAkademik'])->name('api.tahun-akademik');
});

// Alumni-only routes
Route::middleware(['auth', 'cekrole:alumni'])->group(function () {
    Route::get('/kuesioner', [KuesionerAlumniController::class, 'index'])->name('tracer.kuesioner');
    Route::post('/kuesioner/store', [KuesionerAlumniController::class, 'store'])->name('tracer.create');
    Route::get('/kuesioner/edit', [KuesionerAlumniController::class, 'edit'])->name('kuesioner.edit');
    Route::put('/kuesioner/update/{id}', [KuesionerAlumniController::class, 'update'])->name('kuesioner.update');
    Route::put('/kuesioner-pengguna/update/{id}', [TracerStudyController::class, 'update'])->name('tracer.kuesioner-pengguna.update');
    Route::get('/kuesioner-pengguna', [TracerStudyController::class, 'index'])->name('tracer.kuesioner-pengguna');
    Route::post('/kuesioner-pengguna/store', [TracerStudyController::class, 'store'])->name('tracer.store');
    Route::get('/tracer-study/form/{id}', [TracerStudyController::class, 'showStudy'])->name('tracer.showstudy');
    Route::get('/tracer-pengguna/form/{id}', [TracerStudyController::class, 'showPengguna'])->name('tracer.showpengguna');
    Route::get('/kuesioner-pengguna/edit/{id}', [TracerStudyController::class, 'edit'])->name('tracer.kuesioner-pengguna.edit');
    Route::put('/kuesioner-pengguna/update/{id}', [TracerStudyController::class, 'update'])->name('tracer.kuesioner-pengguna.update');
    Route::get('/profil', [ProfileAlumniController::class, 'show'])->name('profile');
    Route::get('/profil/edit', [ProfileAlumniController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/update', [ProfileAlumniController::class, 'update'])->name('profile.update');
});

Route::resource('listtracerpengguna', AdminTracerController::class);
Route::resource('listtraceralumni', TracerAlumniController::class);


// Authenticated routes
Route::middleware('auth')->group(function () {
    // Route::post('/kuesioner/store', [KuesionerAlumni::class, 'create'])->name('tracer.create');
    Route::get('/tracer/user-data', [KuesionerAlumniController::class, 'getUserData'])->name('tracer.user-data');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/tracer/results', [KuesionerAlumniController::class, 'results'])->name('admin.tracer.results');
    Route::get('/tracer/export', [KuesionerAlumniController::class, 'export'])->name('admin.tracer.export');
    Route::delete('/tracer/{id}', [KuesionerAlumniController::class, 'destroy'])->name('admin.tracer.destroy');
});

// Alternative routes if you don't use admin middleware
Route::middleware('auth')->group(function () {
    Route::get('/tracer/results', [KuesionerAlumniController::class, 'results'])->name('tracer.results');
    Route::get('/tracer/export', [KuesionerAlumniController::class, 'export'])->name('tracer.export');
    Route::delete('/tracer/{id}', [KuesionerAlumniController::class, 'destroy'])->name('tracer.destroy');
});
