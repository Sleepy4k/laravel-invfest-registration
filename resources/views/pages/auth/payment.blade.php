<x-layouts.auth title="Pembayaran">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-6 col-xl-3 mx-auto">
                <div class="card">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="{{ url('/') }}" class="noble-ui-logo d-block mb-2">Pembayaran Tim
                                    {{ $user->leader->first()->team->first()->name }}
                                </a>
                                <h5 class="text-muted fw-normal mb-4">Silahkan lakukan pembayaran untuk melanjutkan
                                    pendaftaran sebesar
                                    <b class="text-primary">
                                        {{ $user->leader->first()->team->first()->competition->registration_fee_rupiah }}
                                    </b>
                                </h5>

                                @foreach ($paymentMethods as $paymentMethod)
                                    <div class="card mb-3">
                                        <div class="card-body d-flex gap-3 align-items-center ">
                                            <img src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->name }}"
                                                width="60" height="60" class="rounded-2">
                                            <div class="information ">
                                                <h2 class="card-title mb-0">
                                                    {{ $paymentMethod->name }}
                                                </h2>
                                                <p class="card-text">
                                                    {{ $paymentMethod->number }} an {{ $paymentMethod->owner }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <form action="{{ route('payment-team.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="team_id" value="{{ $user->leader->first()->team->first()->id }}">
                                    <x-input.select name="payment_method_id" value=""
                                        label="Pilih Metode Pembayaran">
                                        <option value="">Pilih Metode Pembayaran</option>
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">
                                                {{ $paymentMethod->name }}
                                            </option>
                                        @endforeach
                                    </x-input.select>
                                    <x-input.file name="proof" value="" label="Bukti Pembayaran" />
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
