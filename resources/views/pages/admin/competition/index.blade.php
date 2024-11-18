<x-layouts.admin title="Kompetisi">
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.competition.index') }}">Manajemen Kompetisi</a>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.competition.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Kompetisi</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Kompetisi">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Kompetisi</th>
                            <th>Tingkat</th>
                            <th>Poster</th>
                            <th>Guide Book</th>
                            <th>Link Grup Whatsapp</th>
                            <th>Biaya Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($competitions as $competition)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $competition?->name }}</td>
                                <td>{{ $competition?->level?->display_as }}</td>
                                <td>
                                    <a href="{{ isset($competition->poster) ? asset($competition->poster) : '#' }}" class="d-block" data-lightbox="poster"
                                        data-title="{{ $competition->name }}">
                                        <img src="{{ isset($competition->poster) ? asset($competition->poster) : '#' }}" alt="{{ $competition?->name }}"
                                            class="img-table-lightbox" loading="lazy">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ isset($competition->guidebook) ? asset($competition->guidebook) : '#' }}" class="btn btn-primary btn-sm"
                                        target="_blank">Lihat</a>
                                </td>
                                <td>
                                    <a href="{{ $competition?->whatsapp_group ?? '#' }}" class="btn btn-primary btn-sm"
                                        target="_blank">Lihat</a>
                                </td>
                                <td>{{ $competition?->registration_fee_rupiah }}</td>
                                <td>
                                    <a href="{{ route('admin.competition.edit', $competition->id) }}"
                                        class="btn btn-warning btn-sm me-2">Edit</a>
                                    <a href="{{ route('admin.competition.show', $competition->id) }}"
                                        class="btn btn-info btn-sm me-2">Detail</a>
                                    <form action="{{ route('admin.competition.destroy', $competition->id) }}"
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
            })
        </script>
    @endpush
</x-layouts.admin>
