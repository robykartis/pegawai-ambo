@section('title')
    Siswa
@endsection
<div>
    <!-- HEADER -->
    <x-header title="Data Siswa" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>

        <x-slot:actions>
            <x-button label="Tambah" link="/tambah/siswa" responsive icon-right="o-x-circle" />
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>

    </x-header>


    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$siswa" with-pagination />
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/2">

        {{-- Notice `searchable` + `single` --}}
        <x-choices label="Nama Siswa Single" wire:model="user_Single" :options="$usersSingle" search-function="Cari_single"
            single searchable />



        {{-- <x-choices label="Alamat Siswa Multi" wire:model="user_Multi" :options="$usersMulti" search-function="Cari_multi"
            searchable /> --}}
        <x-choices label="Alamat Siswa Multi" wire:model="user_Multi" :options="$usersMulti" search-function="Cari_multi"
            searchable>
            {{-- Item slot --}}
            @scope('item', $usersMulti)
                <x-list-item :item="$usersMulti" sub-value="bio">
                    <x-slot:actions>
                        <x-badge :value="$usersMulti->alamat" />
                    </x-slot:actions>
                </x-list-item>
            @endscope


            {{-- Selection slot --}}
            @scope('selection', $usersMulti)
                {{ $usersMulti->alamat }}
            @endscope


        </x-choices>
        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="save" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
