<x-layouts.admin title="Tingkat Sponsor">
    @pushOnce('plugin-styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/datatables/datatables.min.css') }}"/>
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
        <script type="text/javascript" src="{{ asset('admin/assets/plugins/datatables/datatables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endPushOnce
</x-layouts.admin>
