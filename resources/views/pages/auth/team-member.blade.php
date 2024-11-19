<x-layouts.auth title="Pengisian Anggota Team">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-6 col-xl-5 mx-auto">
                <div class="card">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="{{ url('/') }}" class="noble-ui-logo d-block mb-2">Daftar Member Tim
                                    {{ auth('web')->user()->leader?->first()->team?->name }}
                                </a>
                                <h5 class="text-muted fw-normal mb-4">
                                    Isi data dengan benar, tidak bisa diubah kembali
                                </h5>
                                <div class="alert alert-danger" id="alert-team-required">
                                    <ul class="mb-0">
                                        <li>Memiliki minimal 1 anggota team</li>
                                    </ul>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('team-members.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <x-input.text label="Anggota 1" name="data[0][member]" placeholder="Nama Lengkap"
                                        value="{{ old('member_1') }}" />
                                    <x-input.file label="Kartu Pelajar/KTM Anggota 1" name="data[0][card]" />
                                    <x-input.text label="Anggota 2" name="data[1][member]" placeholder="Nama Lengkap"
                                        value="{{ old('member_2') }}" />
                                    <x-input.file label="Kartu Pelajar/KTM Anggota 2" name="data[1][card]" />
                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Lanjutkan ke Pembayaran
                                    </x-button.primary>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkTeamMembers() {
            const member1 = $('input[name="data[0][member]"]').val();
            const member2 = $('input[name="data[1][member]"]').val();
            const alertTeamRequired = $('#alert-team-required');

            if (member1 || member2) {
                alertTeamRequired.hide();
            } else {
                alertTeamRequired.show();
            }
        }

        $(document).ready(function() {
            checkTeamMembers();
            $('input[name="data[0][member]"], input[name="data[1][member]"]').on('input', function() {
                checkTeamMembers();
            });
        });
    </script>
</x-layouts.auth>
