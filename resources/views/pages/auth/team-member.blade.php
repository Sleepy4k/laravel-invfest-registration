<x-layouts.auth title="Pengisian Team">
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
                                    <span style="color: red;">* Minimal memiliki 1 anggota team selain ketua team</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
