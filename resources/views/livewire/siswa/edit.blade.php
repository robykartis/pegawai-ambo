@section('title')
    Edit Siswa
@endsection
<div>
    <div class="flex">
        <div class="w-full p-4">
            <!-- HEADER -->
            <x-header title="Tambah Siswa" progress-indicator />
            <x-card title="Form Siswa" progress-indicator>
                <x-form wire:submit="update">
                    <x-input label="Nama Siswa" wire:model="name" />
                    <x-input label="Nis Siswa" wire:model="nis" />
                    <x-input label="Alamat Siswa" wire:model="alamat" />

                    <x-slot:actions>
                        <x-button label="Cancel" link="/" />
                        <x-button label="Update" class="btn-primary" type="submit" spinner="save2" />
                    </x-slot:actions>
                </x-form>
            </x-card>
        </div>

    </div>
</div>
