<?php

use App\Livewire\AddSubject;
use App\Livewire\Dashboard\TaskDashboard;
use App\Livewire\EditSubject;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// dashboard
Route::get('/dashboard', TaskDashboard::class)->middleware(['auth'])->name('dashboard');

// students
Route::middleware(['auth'])->group(function () {
    Route::get('/create/subject', AddSubject::class)->name('add.subject');
    Route::get('/edit/subject/{subject}', EditSubject::class)->name('edit.subject');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
