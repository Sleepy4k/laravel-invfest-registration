<x-layouts.admin title="Edit Tingkatan">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.tier.index') }}">Tingkat Sponsor</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <a href="{{ route('admin.tier.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Tingkatan">
                <form action="{{ route('admin.tier.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-input.text label="Nama Tingkatan" name="tier" :value="$data->tier" />
                    <x-button.primary class="float-end" type="submit">
                        Update
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
