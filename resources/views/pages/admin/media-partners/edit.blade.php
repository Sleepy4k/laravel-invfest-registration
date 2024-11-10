<x-layouts.admin title="Tambah Media Partner">


    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Media Partner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.media-partner.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Media Partner">
                <form action="{{ route('admin.media-partner.update', $mediaPartner->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text label="Nama Media Partner" name="name" :value="$mediaPartner->name" />
                    <x-input.file label="Logo Media Partner" name="logo" :value="$mediaPartner->logo" />
                    <x-input.text label="Link Media Partner" name="link" :value="$mediaPartner->link" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>


</x-layouts.admin>
