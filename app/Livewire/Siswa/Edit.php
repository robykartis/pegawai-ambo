<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;
    #[Validate]
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
    function update()
    {
        $this->validate();
        $siswa = Siswa::find($this->siswaId);
        $siswa->update([
            'name' => $this->name,
            'nis' => $this->nis,
            'alamat' => $this->alamat,
        ]);
        $this->toast(
            type: 'success',
            title: 'Data Berhasil Diupdate',
            description: null,
            position: 'toast-top toast-end',
            icon: 'o-information-circle',
            css: 'alert-info',
            timeout: 3000,
            redirectTo: route('siswa.index')
        );
    }
    public function render()
    {
        return view('livewire.siswa.edit');
    }
}
