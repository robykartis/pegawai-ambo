<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Index extends Component
{
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'nis' => 'asc'];

    // Selected option
    public $user_Single;
    public $user_Multi = [];

    // Options list
    public Collection $usersSingle;
    public Collection $usersMulti;

    public Collection $data;


    public function mount()
    {
        // Fill options when component first renders
        $this->search();
        $this->search_multi();
    }

    // Also called as you type
    public function search(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $this->usersSingle = Siswa::orderBy('name', 'asc')
            ->get()
            ->take(5);
    }

    public function search_multi(string $value = '')
    {

        $this->usersMulti  =  Siswa::select('id', 'alamat')
            ->groupBy('alamat')
            ->orderBy('alamat', 'asc')
            ->take(5)
            ->get();
    }

    function Cari_multi(string $value = '')
    {


        $collection = collect(); // Inisialisasi koleksi kosong

        foreach ($this->user_Multi as $item) {
            $siswa = Siswa::where('id', $item)->first();
            $collection->push($siswa);
        }

        $this->usersMulti = Siswa::where('alamat', 'like', "%$value%")
            ->groupBy('alamat')
            ->orderBy('alamat')
            ->get()
            ->merge($collection);
    }
    function Cari_single($value)
    {
        $this->usersSingle = Siswa::where('name', 'like', "%$value%")
            ->orderBy('name')
            ->get();
    }
    function save()
    {
        foreach ($this->user_Multi as $item) {
            $ala[] = Siswa::select('alamat')->where('id', $item)->first();
        }
        // dd($ala);
    }
    public function render()
    {

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Nama Siswa', 'searchable' => true],
            ['key' => 'nis', 'label' => 'Nis Siswa'],
            ['key' => 'alamat', 'label' => 'Alamat Siswa', 'sortable' => true],
        ];

        return view('livewire.siswa.index', [
            'headers' => $headers,
            'siswa' => Siswa::when($this->user_Multi, function ($query) {
                // return $query->where('column', 'value');
                dd($query);
            })
                ->paginate(10)

        ]);
    }
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
        Siswa::where('id', $id)->delete();
        $this->toast(
            type: 'success',
            title: 'Data Berhasil Dihapus',
            description: null,
            position: 'toast-top toast-end',
            icon: 'o-information-circle',
            css: 'alert-info',
            timeout: 3000,
            redirectTo: route('siswa.index')
        );
    }
}
