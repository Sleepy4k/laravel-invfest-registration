<x-layouts.admin title="Edit Kompetisi">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Kompetisi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.competition.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Kompetisi">
                <form action="{{ route('admin.competition.update', $competition->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text label="Nama Kompetisi" name="name" :value="$competition->name" />
                    <x-input.select label="Tingkat" name="level">
                        <option value="sma/smk" {{ $competition->level == 'sma/smk' ? 'selected' : '' }}>SMA/SMK
                        </option>
                        <option value="mahasiswa" {{ $competition->level == 'mahasiswa' ? 'selected' : '' }}>
                            Mahasiswa</option>
                    </x-input.select>
                    <x-input.textarea label="Deskripsi" name="description" :value="$competition->description" />
                    <img src="{{ asset($competition->poster) }}" alt="{{ $competition->name }}" id="poster_preview"
                        width="200" class="mb-3">
                    <x-input.file label="Poster" name="poster" id="poster" />
                    <a href="{{ asset($competition->guidebook) }}" class="btn btn-primary btn-sm mb-3"
                        target="_blank">Lihat Guide Book</a>
                    <x-input.file label="Guide Book" name="guidebook" id="guidebook" />
                    <x-input.text label="Harga Pendaftaran" name="registration_fee" type="number"
                        value="{{ $competition->registration_fee }}" />
                    <x-input.text label="Link Grup Whatsapp" name="whatsapp_group_link"
                        value="{{ $competition->whatsapp_group_link }}" />
                    <x-button.primary class="float-end" type="submit">
                        Update
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#poster').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#poster_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>
    @endpush
</x-layouts.admin>
