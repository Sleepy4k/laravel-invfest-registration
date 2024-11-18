<x-layouts.admin title="Sponsor Event">
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.sponsor.index') }}">Sponsor</a>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.sponsor.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Sponsor</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Sponsor">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Link Sponsor</th>
                            <th>Level Sponsor</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($sponsorships as $sponsorship)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sponsorship->name }}</td>
                                <td>
                                    <a href="{{ isset($sponsorship->logo) ? asset($sponsorship->logo) : '#' }}" data-lightbox="sponsor"
                                        data-title="{{ $sponsorship->name }}">
                                        <img src="{{ isset($sponsorship->logo) ? asset($sponsorship->logo) : '#' }}" alt="{{ $sponsorship->name }}"
                                            class="img-table-lightbox" loading="lazy">
                                    </a>
                                </td>
                                <td>{{ $sponsorship->link ?? '-' }}</td>
                                <td>{{ $sponsorship->tier?->tier }}</td>
                                <td>
                                    <a href="{{ route('admin.sponsor.edit', $sponsorship->id) }}"
                                        class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('admin.sponsor.destroy', $sponsorship->id) }}" method="POST"
                                        class="d-inline">
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
