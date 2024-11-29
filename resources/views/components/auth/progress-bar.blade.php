@php
    $steps = [
        'register' => 'Registrasi Team',
        'email/verify' => 'Verifikasi Kode OTP',
        'team-members' => 'Registrasi Anggota',
        'payment-team' => 'Pembayaran'
    ];
@endphp

<div class="steps">
    <progress id="progress" value={{ $progress }} max=100 ></progress>

    @foreach ($steps as $key => $step)
        <div class="step-item">
            <button class="step-button" aria-expanded="{{ $activeList[$key] ? 'true' : 'false' }}">
                {{ $loop->iteration }}
            </button>
            <p class="step-text">{{ $step }}</p>
        </div>
    @endforeach
</div>
