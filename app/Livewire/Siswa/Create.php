<?php

namespace App\Livewire\Siswa;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name, $nis, $alamat;
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'nis' => 'required|min:5',
            'alamat' => 'required',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        dd($validated);
    }


    public function render()
    {
        return view('livewire.siswa.create');
    }
}
