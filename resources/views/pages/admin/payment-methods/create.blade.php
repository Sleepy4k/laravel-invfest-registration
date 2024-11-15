<x-layouts.admin title="Tambah Metode Pembayaran">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.payment-method.index') }}">Metode Pembayaran</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <a href="{{ route('admin.payment-method.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Metode Pembayaran">
                <form action="{{ route('admin.payment-method.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input.text label="Nama" name="name" />
                    <x-input.file label="Logo" name="logo" />
                    <x-input.text label="No Rekening/No Hp" name="number" />
                    <x-input.text label="Atas Nama" name="owner" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>

    @push('custom-scripts')
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
    @endpush
</x-layouts.admin>
