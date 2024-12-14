<x-layouts.admin title="Konfigurasi Permintaan">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.request-settings.index') }}">Manajemen Permintaan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Konfigruasi</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Konfigurasi Permintaan">
                <form action="{{ route('admin.request-settings.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="alert alert-warning mt-3">
                                <strong>Perhatian!</strong> Pastikan Anda mengatur ukuran maksimum file upload pada konfigurasi hosting Anda.
                            </div>

                            <x-input.text
                                id="image_mimes"
                                name="image_mimes"
                                label="Jenis Mime Gambar yang Diizinkan (eg: jpg, png, gif)"
                                value="{{ $content['image_mimes'] ?? '' }}"
                            />
                            <x-input.text
                                id="image_max_size"
                                name="image_max_size"
                                label="Ukuran Gambar Maksimum (KB)"
                                value="{{ $content['image_max_size'] ?? '' }}"
                            />
                            <x-input.text
                                id="document_mimes"
                                name="document_mimes"
                                label="Jenis Mime Dokumen yang Diizinkan (eg: pdf,rar,docx)"
                                value="{{ $content['document_mimes'] ?? '' }}"
                            />
                            <x-input.text
                                id="document_max_size"
                                name="document_max_size"
                                label="Ukuran Dokumen Maksimum (KB)"
                                value="{{ $content['document_max_size'] ?? '' }}"
                            />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>

    @pushOnce('custom-scripts')
        <script>
            function manipulateInputForSize() {
                this.value = this.value.replace(/[^0-9]/g, '');
            }

            function manipulateInputForMimes() {
                this.value = this.value.replace(/[^a-zA-Z,]/g, '');
            }

            const imageMaxSize = document.getElementById('image_max_size');
            const documentMaxSize = document.getElementById('document_max_size');

            imageMaxSize?.addEventListener('input', manipulateInputForSize);
            documentMaxSize?.addEventListener('input', manipulateInputForSize);

            const imageMimes = document.getElementById('image_mimes');
            const documentMimes = document.getElementById('document_mimes');

            imageMimes?.addEventListener('input', manipulateInputForMimes);
            documentMimes?.addEventListener('input', manipulateInputForMimes);

            // Change all mime types to lowercase on submit and on blur
            const form = document.querySelector('form');

            form?.addEventListener('submit', function() {
                imageMimes.value = imageMimes.value.toLowerCase();
                documentMimes.value = documentMimes.value.toLowerCase();
            });

            imageMimes?.addEventListener('blur', function() {
                this.value = this.value.toLowerCase();
            });

            documentMimes?.addEventListener('blur', function() {
                this.value = this.value.toLowerCase();
            });
        </script>
    @endPushOnce
</x-layouts.admin>
