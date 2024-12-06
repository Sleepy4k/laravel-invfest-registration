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
            <x-admin.card title="Data Konfigurasi">
                <form action="{{ route('admin.request-settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <h5 class="mb-3">Konfigurasi Permintaan</h5>
                            <x-input.text name="image_mimes" label="Allowed Image Mime Types (ex: jpg,png,gif)" value="{{ $content['image_mimes'] ?? '' }}" />
                            <x-input.text id="image_max_size" name="image_max_size" label="Max Image Size (KB)" />
                            <x-input.text name="document_mimes" label="Allowed Document Mime Types (ex: pdf,rar,docx)" />
                            <x-input.text id="document_max_size" name="document_max_size" label="Max Document Size (KB)" />
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
            function manipulateInput() {
                this.value = this.value.replace(/[^0-9]/g, '');
            }

            document.getElementById('image_max_size')?.addEventListener('input', manipulateInput);
            document.getElementById('document_max_size')?.addEventListener('input', manipulateInput);
        </script>
    @endPushOnce
</x-layouts.admin>
