<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'users.index');
Volt::route('/siswa', 'siswa.index')->name('siswa.index');
Volt::route('/siswa/tambah', 'siswa.create')->name('siswa.create');
Volt::route('/siswa/show/{id}', 'siswa.show')->name('siswa.show');
Volt::route('/siswa/edit/{id}', 'siswa.edit')->name('siswa.edit');
