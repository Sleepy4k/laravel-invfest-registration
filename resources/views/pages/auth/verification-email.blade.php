<x-layouts.auth title="Verifikasi Email">
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
                                <a href="{{ route('frontend.landing') }}" class="noble-ui-logo d-block mb-2">
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
