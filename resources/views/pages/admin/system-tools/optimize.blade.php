<x-layouts.admin title="Optimization">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('admin.tools.optimize.index') }}">Optimization</a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card>
                <form action="{{ route('admin.tools.optimize.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <p>
                                Optimize akan membuat aplikasi ini lebih cepat dan ringan, dengan cara menata ulang cache yang ada.
                                <br />
                                Termasuk cache yang disimpan pada file, cache yang disimpan pada database, dan cache yang disimpan pada session.
                                <br />
                                <br />
                                Dengan detail sebagai berikut:
                                <br />
                                - Cache yang disimpan pada file: <code>storage/framework/cache/data</code>
                                <br />
                                - Cache yang disimpan pada database: <code>cache</code>
                                <br />
                                - Cache yang disimpan pada session: <code>session</code>
                                <br />
                                - Cache yang disimpan pada view: <code>storage/framework/views</code>
                                <br />
                                - Cache yang disimpan pada route: <code>routes/web.php</code>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Optimize
                        </button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>

    @pushOnce('custom-scripts')
        <script src="{{ asset('vendor/sweetalert/sweetalert.all.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('form').submit(function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Apakah Anda yakin ingin mengoptimalkan aplikasi ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, optimalkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).off('submit').submit();
                        }
                    });
                });
            });
        </script>
    @endPushOnce
</x-layouts.admin>
