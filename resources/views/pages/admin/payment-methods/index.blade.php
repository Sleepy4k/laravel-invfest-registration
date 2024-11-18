<x-layouts.admin title="Metode Pembayaran">
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.payment-method.index') }}">Metode Pembayaran</a>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.payment-method.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Metode</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Metode Pembayaran">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>No Rekening/No Hp</th>
                            <th>Atas Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($methods as $method)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $method->name }}</td>
                                <td>
                                    <a href="{{ isset($method->logo) ? asset($method->logo) : '#' }}" data-lightbox="payment-methods"
                                        data-title="{{ $method->name }}">
                                        <img src="{{ isset($method->logo) ? asset($method->logo) : '#' }}" alt="{{ $method->name }}"
                                            class="img-table-lightbox" loading="lazy">
                                    </a>
                                </td>
                                <td>{{ $method->number }}</td>
                                <td>{{ $method->owner }}</td>
                                <td>
                                    <a href="{{ route('admin.payment-method.edit', $method->id) }}"
                                        class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('admin.payment-method.destroy', $method->id) }}"
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
