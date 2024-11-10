<x-layouts.admin title="Metode Pembayaran">
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush


    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Metode Pembayaran</a></li>
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
                        @foreach ($paymentMethods as $paymentMethod)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $paymentMethod->name }}</td>
                                <td>
                                    <a href="{{ asset($paymentMethod->logo) }}" data-lightbox="payment-methods"
                                        data-title="{{ $paymentMethod->name }}">
                                        <img src="{{ asset($paymentMethod->logo) }}" alt="{{ $paymentMethod->name }}"
                                            class="img-table-lightbox">
                                    </a>
                                </td>
                                <td>{{ $paymentMethod->number }}</td>
                                <td>{{ $paymentMethod->owner }}</td>
                                <td>
                                    <a href="{{ route('admin.payment-method.edit', $paymentMethod->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.payment-method.destroy', $paymentMethod->id) }}"
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
        <script src="{{ asset('admin/assets/plugins/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
    @endpush
</x-layouts.admin>
