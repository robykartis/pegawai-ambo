<?php

use Livewire\Volt\Volt;

Volt::route('/', 'users.index');
Volt::route('/siswa', 'siswa.index');
Volt::route('/tambah/siswa', 'siswa.create');
