<x-layouts.admin title="Clear Cache">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('admin.tools.clear-cache.index') }}">Clear Cache</a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card>
                <form action="{{ route('admin.tools.clear-cache.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <p>
                                Clear cache akan menghapus semua cache yang ada pada aplikasi ini.
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
                            Clear Cache
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
                        text: "Anda akan menghapus semua cache yang ada pada aplikasi ini.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus cache!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.submit();
                        }
                    });
                });
            });
        </script>
    @endPushOnce
</x-layouts.admin>
