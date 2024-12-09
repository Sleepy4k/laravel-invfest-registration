<x-layouts.admin title="Tingkat Sponsor">
    @pushOnce('plugin-styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/sc-2.0.7/sl-1.4.0/datatables.min.css"/>
    @endPushOnce

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.tier.index') }}">Tingkat Sponsor</a>
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.tier.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Tingkatan</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Sponsor">
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