<x-layouts.dashboard-team title="Dashboard Tim {{ $user->leader->first()->team->first()->name }}">
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    @if ($user->leader->first()->team->first()->payment == null)
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Anda belum melakukan pembayaran. Silahkan melakukan pembayaran terlebih dahulu.
            <a href="{{ route('payment-team') }}" target="_blank" class="alert-link">
                Bayar Sekarang
            </a>
        </div>
    @elseif ($user->leader->first()->team->first()->payment->first()->status == 'pending')
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Tim anda sedang dalam proses verifikasi oleh admin. Silahkan menunggu.
            <a href="{{ 'https://api.whatsapp.com/send/?phone=' . $appSettings['team_name'] . ' ingin menanyakan status verifikasi tim saya.' }}"
                target="_blank" class="alert-link">Hubungi
                Admin</a>
        </div>
    @else
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            Tim anda sudah diverifikasi oleh admin. Silahkan join grup whatsapp kami
            <a href="{{ $user->leader->first()->team->first()->competition->first()->whatsapp_group }}" target="_blank"
                class="alert-link">Link Grup
                Whatsapp</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Kompetisi</th>
                        <td>{{ Auth::user()->teams->first()->competition->name }}</td>
                    </tr>
                    <tr>
                        <th>Tingkat</th>
                        <td>
                            {{ Auth::user()->teams->first()->competition->level == 'sma/smk' ? 'SMA/SMK' : 'Mahasiswa' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Tim</th>
                        <td>{{ Auth::user()->teams->first()->team_name }}</td>
                    </tr>
                    <tr>
                        <th>Asal Instansi</th>
                        <td>{{ Auth::user()->teams->first()->institution }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ketua</th>
                        <td>{{ Auth::user()->teams->first()->leader_name }}</td>
                    </tr>
                    <tr>
                        <th> Kartu Pelajar / Mahasiswa Ketua</th>
                        <td>
                            <a href="{{ asset(Auth::user()->teams->first()->leader_card) }}" data-lightbox="image-1"
                                data-title="Kartu Identitas {{ Auth::user()->teams->first()->leader_name }}">
                                Kartu Pelajar / Mahasiswa
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Email Ketua</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th>No. HP Ketua</th>
                        <td>{{ Auth::user()->teams->first()->leader_phone }}</td>
                    </tr>
                    <tr>
                        <th>Anggota</th>
                        <td>
                            <ul>
                                @foreach (Auth::user()->teams->first()->members as $member)
                                    <li>
                                        {{ $member->name ?? 'Tidak Ada' }} <a href="{{ asset($member->card) }}"
                                            data-lightbox="image-1"
                                            data-title="Kartu Identitas {{ $member->name ?? 'Tidak Ada' }}">
                                            Kartu Pelajar / Mahasiswa
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @if (Auth::user()->teams->first()->companion_name != null)
                        <tr>
                            <th>Nama Pembimbing</th>
                            <td>{{ Auth::user()->teams->first()->companion_name }}</td>
                        </tr>
                        <tr>
                            <th>Kartu Identitas Pembmbing</th>
                            <td>
                                <a href="{{ asset(Auth::user()->teams->first()->companion_card) }}"
                                    data-title="Kartu Identitas {{ Auth::user()->teams->first()->companion_name }}">
                                    Kartu Identitas Pembimbing </a>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>
                            {{ Auth::user()->teams->first()->payment->paymentMethod->name }}
                            {{ Auth::user()->teams->first()->payment->paymentMethod->number != null ? ' - ' . Auth::user()->teams->first()->payment->paymentMethod->number : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran</th>
                        <td>
                            <a href="{{ asset(Auth::user()->teams->first()->payment->proof) }}" data-lightbox="image-1"
                                data-title="Bukti Pembayaran {{ Auth::user()->teams->first()->team_name }}">
                                <img src="{{ asset(Auth::user()->teams->first()->payment->proof) }}"
                                    class="img-table-lightbox" width="100">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if (Auth::user()->teams->first()->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif(Auth::user()->teams->first()->status == 'accepted')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

    @push('plugin-scripts')
        <script src="{{ asset('admin/assets/plugins/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
    @endpush
</x-layouts.dashboard-team>
