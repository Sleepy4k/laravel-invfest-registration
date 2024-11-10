<x-layouts.dashboard-team title="Dashboard Tim {{ Auth::user()->teams->first()->team_name }}">
    @if (Auth::user()->teams->first()->status == 'pending')
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Tim anda sedang dalam proses verifikasi oleh admin. Silahkan menunggu. <a
                href="{{ 'https://api.whatsapp.com/send/?phone=' . getWebConfiguration()->phone . '&text=' . urlencode('Halo, saya ingin menanyakan status verifikasi tim saya.') }}"
                target="_blank" class="alert-link">Hubungi
                Admin</a>
        </div>
    @else
        @php
            $deadline = \Carbon\Carbon::parse(getWebConfiguration()->deadline);
            $now = \Carbon\Carbon::now();
            $diff = $now->diff($deadline);
        @endphp

        @if ($diff->invert == 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Deadline pengumpulan karya {{ $deadline->isoFormat('dddd, D MMMM Y HH:mm') }}. Sisa waktu
                {{ $diff->d }} hari, {{ $diff->h }} jam, {{ $diff->i }} menit, dan {{ $diff->s }}
                detik.
            </div>
            @if (Auth::user()->teams->first()->works)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Karya anda telah dikirimkan, semoga sukses!
                </div>
                <x-input.text label="Judul Karya" value="{{ Auth::user()->teams->first()->works->title }}" readonly />
                <a href="{{ Auth::user()->teams->first()->works->zip_file }}" target="_blank"
                    class="btn btn-primary btn-sm">
                    Unduh Karya
                </a>
            @else
                <form action="{{ route('team.work.store') }}" method="POST" enctype="multipart/form-data"
                    id="form-work">
                    @csrf
                    <x-input.text label="Judul Karya" name="title"
                        value="{{ Auth::user()->teams->first()->works->title ?? '' }}" />
                    <x-input.text label="Zip Karya" name="zip_file" type="file" />
                    <x-button.primary class="float-end" type="submit">
                        Kirim Karya
                    </x-button.primary>
                </form>
            @endif
        @else
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                Deadline pengumpulan karya telah berakhir.
            </div>
            @if (Auth::user()->teams->first()->works)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Karya anda telah dikirimkan, semoga sukses!
                </div>
                <x-input.text label="Judul Karya" value="{{ Auth::user()->teams->first()->works->title }}" readonly />
                <a href="{{ Auth::user()->teams->first()->works->zip_file }}" target="_blank"
                    class="btn btn-primary btn-sm">
                    Unduh Karya
                </a>
            @else
            @endif
        @endif
    @endif

    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#form-work').submit(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda tidak dapat mengubah karya yang sudah dikirimkan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Kirim Karya!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).unbind('submit').submit();
                        }
                    })
                });
            });
        </script>
    @endpush
</x-layouts.dashboard-team>
