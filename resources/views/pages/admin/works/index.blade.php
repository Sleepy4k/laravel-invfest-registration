<x-layouts.admin title="Karya Peserta">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.work.index') }}">Karya Peserta</a>
                </li>
            </ol>
        </nav>
        <div class="dropdown mb-4">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Filter Dari Lomba
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach ($competitions as $competition)
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.work.index') }}?filter={{ $competition->id }}">
                            {{ $competition->name }}
                        </a>
                    </li>
                @endforeach
                <li>
                    <a class="dropdown-item" href="{{ route('admin.work.index') }}">
                        Clear Filter
                    </a>
                </li>
            </ul>
        </div>
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
                                <td>{{ $work->team?->competition?->name }}</td>
                                <td>{{ $work->team->name }}</td>
                                <td>{{ $work->team->institution }}</td>
                                <td>{{ $work->title }}</td>
                                <td>
                                    <a href="{{ $work->file ?? '#' }}" target="_blank" class="btn btn-sm btn-primary">
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
                                    @if ($work->is_reviewed)
                                        <span>-</span>
                                    @else
                                        <form action="{{ route('admin.work.update', $work->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_reviewed" value="1">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i data-feather="check"></i>
                                                Tandai Sudah Direview
                                            </button>
                                        </form>
                                    @endif
                                </td>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
