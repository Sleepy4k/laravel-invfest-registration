<x-layouts.auth title="Pengisian Anggota Team">
    @pushOnce('style')
        <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
    @endPushOnce

    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="mt-6">
                    <x-auth.progress-bar />
                </div>

                <div class="card mt-4">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 ps-5 py-5 pe-5">
                                <a href="{{ route('frontend.landing') }}" class="noble-ui-logo d-block mb-2">Daftar Member Tim
                                    {{ $teamName }}
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
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form
                                    method="POST"
                                    action="{{ route('team-members.store') }}"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @honeypot

                                    <x-input.text
                                        label="Anggota 1"
                                        name="data[0][member]"
                                        class="team-member"
                                        placeholder="Nama Lengkap"
                                        value="{{ old('data[0][member]') }}"
                                    />
                                    <x-input.file
                                        name="data[0][card]"
                                        label="Kartu Pelajar/KTM Anggota 1"
                                        accept="image/*"
                                    />
                                    <x-input.text
                                        label="Anggota 2"
                                        name="data[1][member]"
                                        class="team-member"
                                        placeholder="Nama Lengkap"
                                        value="{{ old('data[1][member]') }}"
                                    />
                                    <x-input.file
                                        label="Kartu Pelajar/KTM Anggota 2"
                                        name="data[1][card]"
                                        accept="image/*"
                                    />
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

    @pushOnce('custom-scripts')
        <script>
            function checkTeamMembers() {
                const member1Input = document.querySelector('input[name="data[0][member]"]');
                const member2Input = document.querySelector('input[name="data[1][member]"]');
                const alertTeamRequired = document.getElementById('alert-team-required');

                const member1 = member1Input ? member1Input.value : '';
                const member2 = member2Input ? member2Input.value : '';

                if (member1 || member2) {
                    alertTeamRequired.style.display = 'none';
                } else {
                    alertTeamRequired.style.display = 'block';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                checkTeamMembers();
                $('.team-member').on('input', function() {
                    checkTeamMembers();
                });
            });
        </script>
    @endPushOnce
</x-layouts.auth>
