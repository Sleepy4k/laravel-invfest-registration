<x-layouts.admin title="Tambah Level Kompetisi">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.level.index') }}">Manajemen Level Kompetisi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <a href="{{ route('admin.level.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Level Kompetisi">
                <form action="{{ route('admin.level.store') }}" method="POST">
                    @csrf

                    <x-input.text label="Level Kompetisi" name="level" id="level" value="{{ old('level') }}"/>
                    <x-input.text label="Nama Level" name="display_as" id="display_as" value="{{ old('display_as') }}"/>
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
                $('#level').on('input', function() {
                    var level = $(this).val();
                    $(this).val(level.replace(/[^a-zA-Z ]/g, ''));

                    var displayAs = level.toLowerCase()
                        .replace(/ /g, '_')
                        .replace(/(?:^|\s)\S/g, function(a) {
                            return a.toUpperCase();
                        });
                    $('#display_as').val(displayAs);
                });
            });
        </script>
    @endPushOnce
</x-layouts.admin>
