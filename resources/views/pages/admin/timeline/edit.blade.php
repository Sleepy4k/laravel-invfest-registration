<x-layouts.admin title="Edit Timeline">

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Timeline</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.timeline.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>

    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Kompetisi">
                <form action="{{ route('admin.timeline.update', $timeline->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text label="Nama Schedule" name="title" :value="$timeline->title" />
                    <x-input.date label="Tanggal" name="date" :value="date('Y-m-d', strtotime($timeline->date))" />
                    <x-input.textarea label="Deskripsi" name="description" :value="$timeline->description" />
                    <x-button.primary class="float-end" type="submit">
                        Update
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
