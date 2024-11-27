<x-layouts.admin title="Tambah Sponsor">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.sponsor.index') }}">Sponsor</a>
                </li>
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
                    <x-input.file label="Logo Sponsor" name="logo" accept="image/*" />
                    <x-input.text label="Link Sponsor" name="link" />
                    <x-input.select name="tier_id" label="Level Sponsor">
                        @foreach ($tiers as $tier)
                            <option value="{{ $tier->id }}">{{ $tier->tier }}</option>
                        @endforeach
                    </x-input.select>
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>

    @pushOnce('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#logo').change(function() {
                    var file = this.files[0];
                    var $imagePreview = $('#logo_preview');

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
