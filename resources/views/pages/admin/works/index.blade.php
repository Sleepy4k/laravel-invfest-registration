<x-layouts.admin title="Karya Peserta">
    @pushOnce('plugin-styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/datatables/datatables.min.css') }}"/>
    @endPushOnce

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
                {{ $dataTable->table() }}
            </x-admin.card>
        </div>
    </div>

    @pushOnce('plugin-scripts')
        <script type="text/javascript" src="{{ asset('admin/assets/plugins/datatables/datatables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endPushOnce
</x-layouts.admin>
