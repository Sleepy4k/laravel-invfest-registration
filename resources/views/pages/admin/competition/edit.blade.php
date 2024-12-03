<x-layouts.admin title="Edit Kompetisi">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.competition.index') }}">Manajemen Kompetisi</a>
                </li>
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
                    <x-input.select label="Tingkat" name="level_id">
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}" @selected($competition?->level_id == $level->id)>{{ $level->display_as }}</option>
                        @endforeach
                    </x-input.select>
                    <x-input.textarea label="Deskripsi" name="description" :value="$competition->description" />
                    <x-input.file label="Poster" name="poster" id="poster" accept="image/*" />
                    <a href="{{ $competition->guidebook ?? '#' }}" class="btn btn-primary btn-sm mb-3"
                        target="_blank">Lihat Guide Book</a>
                    <x-input.file label="Guide Book" name="guidebook" id="guidebook" />
                    <x-input.text label="Harga Pendaftaran" name="registration_fee" type="number"
                        value="{{ $competition->registration_fee }}" />
                    <x-input.text label="Link Grup Whatsapp" name="whatsapp_group"
                        value="{{ $competition->whatsapp_group }}" />
                    <x-button.primary class="float-end" type="submit">
                        Update
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>

    @pushOnce('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#poster').change(function() {
                    var file = this.files[0];
                    var $imagePreview = $('#poster_preview');

                    $imagePreview.empty();

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            var src = e.target.result;
                            if (src && src !== '#') {
                                var $img = $('<img>').attr('src', src).css({
                                    width: '100px',
                                    height: '100px'
                                });
                                $imagePreview.append($img);
                                $imagePreview.css('display', 'grid');
                            };
                        };
                        reader.readAsDataURL(this.files[0]);
                    } else {
                        $imagePreview.css('display', 'none');
                    }
                });
            });
        </script>
    @endPushOnce
</x-layouts.admin>
