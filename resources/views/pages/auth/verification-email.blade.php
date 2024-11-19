<x-layouts.auth title="Verifikasi Email">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-6 col-xl-3 mx-auto">
                <div class="card">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="{{ url('/') }}" class="noble-ui-logo d-block mb-2">
                                    Verifikasi Email
                                </a>
                                <h5 class="text-muted fw-normal mb-4">
                                    Silahkan masukan kode verifikasi yang telah dikirimkan ke email anda.
                                </h5>
                                <form action="{{ route('verification.send') }}" method="POST">
                                    @csrf
                                    <x-input.text name="otp" label="Kode Verifikasi" />
                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Verifikasi
                                    </x-button.primary>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
