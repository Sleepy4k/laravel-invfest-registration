<x-layouts.admin title="Tambah Timeline">

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Timeline</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>
        </nav>
        <a href="{{ route('admin.timeline.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Timeline">
                <form action="{{ route('admin.timeline.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input.text label="Nama Schedule" name="title" value="{{ old('title') }}"/>
                    <x-input.textarea label="Deskripsi" name="description"  value="{{ old('description') }}" />
                    <x-input.date label="Tanggal" name="date" value="{{ old('date') }}" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>


</x-layouts.admin>
