<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    public $siswaId, $name, $nis, $alamat;
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'nis' => 'required|min:5',
            'alamat' => 'required',
        ];
    }
    public function mount($id)
    {
        $siswa = Siswa::find($id);
        $this->siswaId   = $siswa->id;
        $this->name    = $siswa->name;
        $this->nis  = $siswa->nis;
        $this->alamat  = $siswa->alamat;
    }
    public function render()
    {
        return view('livewire.siswa.show');
    }
}
