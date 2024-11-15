<x-layouts.admin title="Media Partner Event">
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.media-partner.index') }}">Media Partner</a>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.media-partner.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Media
            Partner</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Media Partner">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Link Media Partner</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($mediaPartners as $mediapartner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mediapartner->name }}</td>
                                <td>
                                    <a href="{{ asset($mediapartner->logo) }}" data-lightbox="mediapartner"
                                        data-title="{{ $mediapartner->name }}">
                                        <img src="{{ asset($mediapartner->logo) }}" alt="{{ $mediapartner->name }}"
                                            class="img-table-lightbox">
                                    </a>
                                </td>
                                <td>{{ $mediapartner->link ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.media-partner.edit', $mediapartner->id) }}"
                                        class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('admin.media-partner.destroy', $mediapartner->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>

    @push('plugin-scripts')
        <script src="{{ asset('admin/assets/plugins/lightbox/js/lightbox.js') }}"></script>

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });
        </script>
    @endpush
</x-layouts.admin>
