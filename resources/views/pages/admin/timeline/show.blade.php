<x-layouts.admin title="{{ $timeline->title }}">

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Timelien</a></li>
                <li class="breadcrumb-item active">{{ $timeline->title }}</li>
            </ol>
        </nav>
        <a href="{{ route('admin.timeline.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="{{ $timeline->name }}">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>Nama Schedule</th>
                                <td>{{ $timeline->title }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $timeline->date }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $timeline->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>

</x-layouts.admin>
