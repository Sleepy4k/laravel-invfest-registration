<x-layouts.admin title="Tim Peserta">
    @pushOnce('plugin-styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/sc-2.0.7/sl-1.4.0/datatables.min.css"/>
    @endPushOnce

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.team.index') }}">Tim Peserta</a>
                </li>
            </ol>
        </nav>
        <div class="dropdown mb-4">
            <button class="btn btn-secondary dropdown-toggle me-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Filter Dari Status
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.team.index', array_merge(request()->query(), ['status' => 'paid'])) }}">
                        Sudah Bayar
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.team.index', array_merge(request()->query(), ['status' => 'unpaid'])) }}">
                        Belum Bayar
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.team.index', request()->except('status')) }}">
                        Clear Filter
                    </a>
                </li>
            </ul>

            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Filter Dari Lomba
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                @foreach ($competitions as $competition)
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.team.index', array_merge(request()->query(), ['filter' => $competition->id])) }}">
                            {{ $competition->name }}
                        </a>
                    </li>
                @endforeach
                <li>
                    <a class="dropdown-item" href="{{ route('admin.team.index', request()->except('filter')) }}">
                        Clear Filter
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tim Peserta">
                {{ $dataTable->table() }}
            </x-admin.card>
        </div>
    </div>

    @pushOnce('plugin-scripts')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/sc-2.0.7/sl-1.4.0/datatables.min.js"></script>
        <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endPushOnce
</x-layouts.admin>
