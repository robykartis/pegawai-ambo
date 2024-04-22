@section('title')
    Tambah Siswa
@endsection
<div>
    <div class="flex">
        <div class="w-full p-4">
            <!-- HEADER -->
            <x-header title="Tambah Siswa" progress-indicator />
            <x-card title="Form Siswa" progress-indicator>
                <x-form wire:submit="save">
                    <x-input label="Nama Siswa" wire:model="name" />
                    <x-input label="Nis Siswa" wire:model="nis" />
                    <x-input label="Alamat Siswa" wire:model="alamat" />

                    <x-slot:actions>
                        <x-button label="Cancel" link="/siswa" />
                        <x-button label="Save" class="btn-primary" type="submit" spinner="save2" />
                    </x-slot:actions>
                </x-form>
            </x-card>
        </div>

    </div>
</div>
