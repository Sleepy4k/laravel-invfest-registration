<x-layouts.admin title="Edit Sponsor">

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sponsor</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.payment-method.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>

    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Sponsor">
                <form action="{{ route('admin.sponsor.update', $sponsor->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text name="name" label="Nama Sponsor" :value="$sponsor->name" />
                    <x-input.file name="logo" label="Logo Sponsor" :value="$sponsor->logo" />
                    <x-input.text name="link" label="Link Sponsor" :value="$sponsor->link" />
                    <x-input.select name="level" label="Level Sponsor">
                        <option value="bronze" {{ $sponsor->level == 'bronze' ? 'selected' : '' }}>Bronze</option>
                        <option value="silver" {{ $sponsor->level == 'silver' ? 'selected' : '' }}>Silver</option>
                        <option value="gold" {{ $sponsor->level == 'gold' ? 'selected' : '' }}>Gold</option>
                        <option value="platinum" {{ $sponsor->level == 'platinum' ? 'selected' : '' }}>Platinum</option>
                    </x-input.select>
                    <x-button.primary class="float-end" type="submit">
                        Update
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>



    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#poster').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#poster_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>
    @endpush
</x-layouts.admin>
