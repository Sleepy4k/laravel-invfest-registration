<x-layouts.dashboard-team title="Dashboard Tim {{ $user->leader->first()->team->first()->name }}">
    @push('plugin-styles')
        <link rel="stylesheet"
            href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    @php
        $team = $user->leader->first()->team->first();
        $payment = $team->payment->first();
        $competition = $team->competition->first();
        $leader = $user->leader->first();
    @endphp

    @if(is_null($payment))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Anda belum melakukan pembayaran. Silahkan melakukan pembayaran terlebih dahulu.
            <a href="{{ route('payment-team') }}" target="_blank" class="alert-link"> \
                Bayar Sekarang
            </a>
        </div>
    @elseif($payment->status != 'pending')
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Tim anda sedang dalam proses verifikasi oleh admin. Silahkan menunggu.
            <a
                href="{{ 'https://api.whatsapp.com/send/?phone=' . $appSettings['phone'] . '&text=ingin%20menanyakan%20status%20verifikasi%20tim%20saya.' }}"
                target="_blank"
                class="alert-link"
            >
                Hubungi Admin
            </a>
        </div>
    @else
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            Tim anda sudah diverifikasi oleh admin. Silahkan join grup whatsapp kami
            <a href="{{ $competition->whatsapp_group }}" target="_blank" class="alert-link">
                Link Grup Whatsapp
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" />
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Kompetisi</th>
                        <td>{{ $competition->name }}</td>
                    </tr>
                    <tr>
                        <th>Tingkat</th>
                        <td> {{ $competition->level->first()->level == 'sma/smk' ? 'SMA/SMK' : 'Mahasiswa' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Tim</th>
                        <td>{{ $team->name }}</td>
                    </tr>
                    <tr>
                        <th>Asal Instansi</th>
                        <td>{{ $team->institution }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ketua</th>
                        <td>{{ $leader->name }}</td>
                    </tr>
                    <tr>
                        <th>Kartu Pelajar / Mahasiswa Ketua</th>
                        <td> <a href="{{ isset($leader->card) ? asset($leader->card) : '#' }}" data-lightbox="image-1" data-title="Kartu Identitas {{ $leader->name }}">
                                Kartu Pelajar / Mahasiswa
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Email Ketua</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>No. HP Ketua</th>
                        <td>{{ $leader->phone }}</td>
                    </tr>
                    <tr>
                        <th>Anggota</th>
                        <td>
                            <ul>
                                @foreach ($team->member as $member)
                                    <li>
                                        {{ $member->name ?? 'Tidak Ada' }}
                                        <a href="{{ asset($member->card) }}" data-lightbox="image-1" data-title="Kartu Identitas {{ $member->name ?? 'Tidak Ada' }}">
                                            Kartu Pelajar / Mahasiswa
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>
                            {{ $payment->method->first()->name }}
                            {{ $payment->method->first()->number ? ' - ' . $payment->method->first()->owner : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran</th>
                        <td>
                            <a href="{{ isset($payment->proof) ? asset($payment->proof) : '#' }}" data-lightbox="image-1" data-title="Bukti Pembayaran {{ $team->name }}">
                                <img
                                    src="{{ isset($payment->proof) ? asset($payment->proof) : '#' }}"
                                    class="img-table-lightbox" width="100"
                                />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($payment->status == 'pending') <span class="badge bg-warning">Pending</span>
                            @elseif($payment->status == 'accepted') <span class="badge bg-success">Diterima</span>
                            @else <span class="badge bg-danger">Ditolak</span> @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

    @push('plugin-scripts')
        <script
            src="{{ asset('admin/assets/plugins/lightbox/js/lightbox-plus-jquery.min.js') }}">
        </script>
        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
    @endpush
</x-layouts.dashboard-team>
