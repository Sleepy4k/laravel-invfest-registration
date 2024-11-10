<x-layouts.admin title="Tambah Sponsor">


    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sponsor</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>
        </nav>
        <a href="{{ route('admin.sponsor.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Sponsor">
                <form action="{{ route('admin.sponsor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input.text label="Nama Sponsor" name="name" />
                    <x-input.file label="Logo Sponsor" name="logo" />
                    <x-input.text label="Link Sponsor" name="link" />
                    <x-input.select label="Level Sponsor" name="level">
                        <option value="bronze">Bronze</option>
                        <option value="silver">Silver</option>
                        <option value="gold">Gold</option>
                        <option value="platinum">Platinum</option>
                    </x-input.select>
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>


</x-layouts.admin>
