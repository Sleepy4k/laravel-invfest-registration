<x-layouts.admin title="Detail Timeline">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.model.index') }}">Log Model</a>
                </li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        <a href="{{ route('admin.model.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="{{ $activity->event }}">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>{{ $activity->id }}</td>
                            </tr>
                            <tr>
                                <th>Event</th>
                                <td>{{ $activity->event }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $activity->description }}</td>
                            </tr>
                            <tr>
                                <th>ID Pelaku</th>
                                <td>{{ $activity->causer_id }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Pelaku</th>
                                <td>{{ $activity->causer_type }}</td>
                            </tr>
                            <tr>
                                <th>ID Subject</th>
                                <td>{{ $activity->causer_id }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Subject</th>
                                <td>{{ $activity->causer_type }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ date('d F Y H:m:s', strtotime($activity->created_at)) }}</td>
                            </tr>
                            <tr>
                                <th>Properti</th>
                                <td>
                                    <textarea cols="30" rows="5" class="form-control" disabled>
                                        {{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
                                    </textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
