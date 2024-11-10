<x-layouts.admin title="Karya Peserta">


    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Tim Peserta</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Karya Peserta">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Lomba</th>
                            <th>Nama Tim</th>
                            <th>Asal Instansi</th>
                            <th>Nama Karya</th>
                            <th>Karya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($works as $work)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $work->team->competition->name }}</td>
                                <td>{{ $work->team->team_name }}</td>
                                <td>{{ $work->team->institution }}</td>
                                <td>{{ $work->title }}</td>
                                <td>
                                    <a href="{{ $work->zip_file }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i data-feather="download"></i>
                                        Download
                                        Karya
                                    </a>
                                </td>
                                <td>
                                    @if ($work->is_reviewed)
                                        <span class="badge bg-success">Sudah Direview</span>
                                    @else
                                        <span class="badge bg-warning">Belum Direview</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.work.update', $work->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_reviewed" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i data-feather="check"></i>
                                            Tandai Sudah Direview
                                        </button>
                                    </form>
                                </td>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
