<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->user()) {
        return redirect('/dashboard');
    } else {
        return view('welcome');
    }
})->name('welcome');
Route::get('/login', function () {
    if (auth()->user()) {
        return redirect('/dashboard');
    } else {
        return view('welcome');
    }
})->name('login');



Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'HomeController@index')->name('home');

    // Rute untuk User
    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/user', 'UserController@store')->name('user.store');
    Route::delete('/user/delete/{id}', 'UserController@destroy')->name('user.destroy');
    Route::put('/user/update/{id}', 'UserController@update')->name('user.update');

    // Rute untuk Kelas
    Route::get('/kelas', 'KelasController@index')->name('kelas');
    Route::post('/kelas', 'KelasController@store')->name('kelas.store');
    Route::delete('/kelas/delete/{id}', 'KelasController@destroy')->name('kelas.destroy');
    Route::put('/kelas/update/{id}', 'KelasController@update')->name('kelas.update');

    // Rute untuk Mata Pelajaran
    Route::get('/mapel', 'MapelController@index')->name('mapel');
    Route::post('/mapel', 'MapelController@store')->name('mapel.store');
    Route::delete('/mapel/delete/{id}', 'MapelController@destroy')->name('mapel.destroy');
    Route::put('/mapel/update/{id}', 'MapelController@update')->name('mapel.update');

    // Rute untuk Mata Pelajaran Kelas
    Route::get('/mapelkelas', 'MapelKelasController@index')->name('mapelkelas');
    Route::post('/mapelkelas', 'MapelKelasController@store')->name('mapelkelas.store');
    Route::delete('/mapelkelas/delete/{id}', 'MapelKelasController@destroy')->name('mapelkelas.destroy');
    Route::put('/mapelkelas/update/{id}', 'MapelKelasController@update')->name('mapelkelas.update');


    Route::get('/materi', 'MateriController@index')->name('materi');
    Route::post('/materi', 'MateriController@store')->name('materi.store');
    Route::delete('/materi/delete/{id}', 'MateriController@destroy')->name('materi.destroy');
    Route::put('/materi/update/{id}', 'MateriController@update')->name('materi.update');

    Route::get('/tugasguru', 'TugasGuruController@index')->name('tugasguru');
    Route::post('/tugasguru', 'TugasGuruController@store')->name('tugasguru.store');
    Route::delete('/tugasguru/delete/{id}', 'TugasGuruController@destroy')->name('tugasguru.destroy');
    Route::put('/tugasguru/update/{id}', 'TugasGuruController@update')->name('tugasguru.update');

    Route::get('/tugasmurid', 'TugasMuridController@index')->name('tugasmurid');
    Route::post('/tugasmurid', 'TugasMuridController@store')->name('tugasmurid.store');
    Route::get('/tugasmurid/{id}', 'TugasMuridController@show')->name('tugasmurid.show');

    // Rute untuk Ganti Password
    Route::post('/change-password', 'UserController@change')->name('change.password');
    Route::put('/update-profile', 'UserController@updateProfile')->name('profile.update');
});
