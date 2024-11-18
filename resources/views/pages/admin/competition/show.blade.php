<x-layouts.admin title="{{ $competition?->name }}">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.competition.index') }}">Manajemen Kompetisi</a>
                </li>
                <li class="breadcrumb-item active">{{ $competition?->name }}</li>
            </ol>
        </nav>
        <a href="{{ route('admin.competition.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="{{ $competition->name }}">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ isset($competition->poster) ? asset($competition->poster) : '#' }}" loading="lazy" alt="image" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>Nama Kompetisi</th>
                                <td>{{ $competition?->name }}</td>
                            </tr>
                            <tr>
                                <th>Tingkat</th>
                                <td>{{ $competition?->level?->display_as }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $competition?->description }}</td>
                            </tr>
                            <tr>
                                <th>Harga Pendaftaran</th>
                                <td>{{ $competition?->registration_fee_rupiah }}</td>
                            </tr>
                            <tr>
                                <th>Guide Book</th>
                                <td>
                                    <a href="{{ isset($competition->guidebook) ? asset($competition->guidebook) : '#' }}" class="btn btn-primary btn-sm"
                                        target="_blank">Lihat</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Link Grup Whatsapp</th>
                                <td>
                                    <a href="{{ $competition?->whatsapp_group }}" class="btn btn-primary btn-sm"
                                        target="_blank">Lihat</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
