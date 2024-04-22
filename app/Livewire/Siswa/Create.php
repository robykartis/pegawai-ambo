<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    #[Validate]
    public $name, $nis, $alamat;
    private function resetInputFields()
    {
        $this->name = '';
        $this->nis = '';
        $this->alamat = '';
    }
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
        Siswa::create($validated);
        $this->toast(
            type: 'success',
            title: 'Data Berhasilwa Ditambahkan',
            description: null,
            position: 'toast-top toast-end',
            icon: 'o-information-circle',
            css: 'alert-info',
            timeout: 3000,
            redirectTo: route('siswa.index')
        );
        $this->resetInputFields();
    }


    public function render()
    {
        return view('livewire.siswa.create');
    }
}
