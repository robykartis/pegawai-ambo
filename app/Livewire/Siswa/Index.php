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
    public string $name = '';
    public string $nis = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'nis' => 'asc'];

    // Selected option
    public ?int $user_Single = null;
    public $user_Multi = [];
    // data alamat
    public $data_alamat = [];

    // Options list
    public Collection $usersSingle;
    public Collection $usersMulti;

    public Collection $data;

    public function updatedSearch()
    {
        $this->resetPage();
    }
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

    public function Cari_single(string $value = '')
    {
        // reset Data single
        // $this->user_Single = null;

        // Pencarian Data Single
        $this->usersSingle =  Siswa::where('name', 'like', "%$value%")
            ->groupBy('name')
            ->get();

        // dd($data);
    }
    function pencarian()
    {
        if ($this->usersSingle) {
            $this->usersSingle =  Siswa::where('id', 'like', '%' . $this->user_Single . '%')
                ->groupBy('name')
                ->get();
        }
        // dd($this->user_Multi);
        // $siswa = Siswa::whereIn('id', $this->user_Multi)->get();
        // dd($siswa);
        if ($this->user_Multi) {
            foreach ($this->user_Multi as $key => $value) {
                $ala[] = Siswa::select('alamat')
                    ->where('id', "$value")
                    ->first();
            }
            // dd($ala);
            $this->data_alamat = [];
            foreach ($ala as $key => $valuea) {
                // dd($valuea->alamat);
                $this->data_alamat[] = $valuea->alamat;
            }
        }
        // dd($this->data_alamat);
    }

    function single_clear()
    {
        $this->user_Single = null;
        $this->user_Multi = [];
        $this->data_alamat = [];
    }

    public function render()
    {

        $headers = [
            ['key' => 'id', 'label' => '#', 'searchable' => true],
            ['key' => 'name', 'label' => 'Nama Siswa', 'searchable' => true],
            ['key' => 'nis', 'label' => 'Nis Siswa', 'sortable' => true],
            ['key' => 'alamat', 'label' => 'Alamat Siswa'],
        ];

        return view('livewire.siswa.index', [
            'headers' => $headers,
            'data' => Siswa::all(),
            'siswa' => Siswa::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('nis', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->name, function ($query) {
                    $query->where('name', 'like', '%' . $this->name . '%');
                })
                ->when($this->user_Single, function ($query) {
                    $query->where('id', 'like', '%' . $this->user_Single . '%');
                })
                ->when($this->nis, function ($query) {
                    $query->where('nis', 'like', '%' . $this->nis . '%');
                })
                ->when($this->user_Single, function ($query) {
                    $query->where('id', $this->user_Single);
                })
                ->when($this->data_alamat, function ($query) {
                    // $query->whereIn('alamat', $this->data_alamat);
                    foreach ($this->data_alamat as $alamat) {
                        // dd($alamat);
                        $query->orWhere('alamat', $alamat);
                    }
                })
                // ->whereIn('alamat', $this->data_alamat)
                ->paginate(10),
        ]);

        // return view('livewire.siswa.index', [
        //     'headers' => $headers,
        //     'siswas'=>Siswa::search($this->search),
        //     'siswa' => Siswa::when($this->user_Multi, function ($query) {
        //         // return $query->where('column', 'value');
        //         dd($query);
        //     })
        //         ->paginate(10)

        // ]);
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
