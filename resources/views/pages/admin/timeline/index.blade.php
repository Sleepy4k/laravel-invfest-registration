<x-layouts.admin title="Timeline">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.timeline.index') }}">Timeline</a>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.timeline.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">
            Tambah Timeline
        </a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="List Timeline">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Schedule</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($timelines as $timeline)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $timeline->title }}</td>
                                <td>{{ $timeline->date }}</td>
                                <td>{{ $timeline->description }}</td>
                                <td>
                                    <a href="{{ route('admin.timeline.edit', $timeline->id) }}"
                                        class="btn btn-warning btn-sm me-2">Edit</a>
                                    <a href="{{ route('admin.timeline.show', $timeline->id) }}"
                                        class="btn btn-info btn-sm me-2">Detail</a>
                                    <form action="{{ route('admin.timeline.destroy', $timeline->id) }}"
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
</x-layouts.admin>
