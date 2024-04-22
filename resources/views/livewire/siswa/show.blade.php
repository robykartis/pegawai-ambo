@section('title')
    Show Siswa
@endsection
<div>
    <div class="flex">
        <div class="w-full p-4">
            <!-- HEADER -->
            <x-header title="Show Siswa" progress-indicator />
            <x-card title="Data Siswa">
                <h1 class="text-2xl"><b>Name :</b> {{ $name }}</h1>
                <h1 class="text-2xl"><b>Nis :</b> {{ $nis }}</h1>
                <h1 class="text-2xl"><b>Alamat :</b> {{ $alamat }}</h1>
                <x-slot:actions>
                    <x-button label="Back" class="btn-primary" link="/siswa" />
                </x-slot:actions>
            </x-card>
        </div>

    </div>
</div>
