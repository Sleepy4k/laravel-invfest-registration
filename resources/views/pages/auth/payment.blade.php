@php
    $team = $user?->leader?->team;
    $competition = $team?->competition;
@endphp

<x-layouts.auth title="Pembayaran">
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
                                    Pembayaran Tim {{ $team?->name }}
                                </a>
                                <h5 class="text-muted fw-normal mb-4">
                                    Silahkan lakukan pembayaran untuk melanjutkan pendaftaran sebesar
                                    <b class="text-primary">
                                        {{ $competition?->registration_fee_rupiah }}
                                    </b>
                                </h5>

                                @foreach ($paymentMethods as $paymentMethod)
                                    <div class="card mb-3">
                                        <div class="card-body d-flex gap-3 align-items-center ">
                                            <img
                                                src="{{ $paymentMethod->logo ?? '#' }}"
                                                alt="{{ $paymentMethod->name ?? '-' }}"
                                                width="60"
                                                height="60"
                                                class="rounded-2"
                                                loading="lazy"
                                            />
                                            <div class="information ">
                                                <h2 class="card-title mb-0">
                                                    {{ $paymentMethod?->name }}
                                                </h2>
                                                <p class="card-text">
                                                    {{ $paymentMethod?->number }} A/N {{ $paymentMethod?->owner }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <form
                                    method="POST"
                                    action="{{ route('payment-team.store') }}"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @honeypot

                                    <input type="hidden" name="team_id" value="{{ $team->id }}">
                                    <x-input.select
                                        name="payment_method_id"
                                        label="Pilih Metode Pembayaran"
                                    >
                                        <option value="">Pilih Metode Pembayaran</option>
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">
                                                {{ $paymentMethod?->name }}
                                            </option>
                                        @endforeach
                                    </x-input.select>
                                    <x-input.file name="proof" value="" label="Bukti Pembayaran" accept="image/*" />
                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Bayar
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
