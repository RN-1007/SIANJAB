<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\DataStaf;
use App\Livewire\DataSummary;
use App\Livewire\DataUraianTugas;
use App\Livewire\DataUraianTugas\DataUraianTugasTable;
use App\Livewire\DataUser;
use App\Livewire\Skpd;
use App\Livewire\StafUser;
use App\Livewire\UraianTugasUser;
use App\Livewire\UraianTugasTusi;
use App\Livewire\UserMaster;
use App\Livewire\Tusi;
use App\Livewire\StrukturJabatan;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Fungsi/route Logout
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/skpd', Skpd::class)->name('skpd');
    Route::get('/data-staf', DataStaf::class)->name('data-staf');
    Route::get('/data-user', DataUser::class)->name('data-user');
    Route::get('/struktur-jabatan', StrukturJabatan::class)->name('struktur-jabatan');
    Route::get('/uraiantugasuser', UraianTugasUser::class)->name('uraiantugasuser');
    Route::get(
        '/tugas-staf-user/{jabatanStafId}',
        StafUser::class
    )->name('staf-user');
    Route::get('/data-summary/{skpd}', DataSummary::class)->name('data-summary');
    Route::get('/uraian-tugas-tusi', UraianTugasTusi::class)->name('uraian-tugas-tusi');
    Route::get('/user-master/{id_jabatan?}', UserMaster::class)->name('user-master');
    Route::get('/tusi', Tusi::class)->name('tusi');
    Route::get('/data-uraian-tugas', DataUraianTugas::class)->name('data-uraian-tugas');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
