<x-layouts.admin title="Tambah Kompetisi">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.competition.index') }}">Manajemen Kompetisi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <a href="{{ route('admin.competition.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Kompetisi">
                <form action="{{ route('admin.competition.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input.text label="Nama Kompetisi" name="name" value="{{ old('name') }}"/>
                    <x-input.select label="Tingkat" name="level_id">
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->display_as }}</option>
                        @endforeach
                    </x-input.select>
                    <x-input.textarea label="Deskripsi" name="description"  value="{{ old('description') }}" />
                    <x-input.file label="Poster" name="poster" accept="image/*" />
                    <x-input.file label="Guide Book" name="guidebook" accept="application/pdf" />
                    <x-input.text label="Harga Pendaftaran" name="registration_fee" type="number" value="{{ old('registration_fee') }}" />
                    <x-input.text label="Link Grup Whatsapp" name="whatsapp_group" value="{{ old('whatsapp_group') }}" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
