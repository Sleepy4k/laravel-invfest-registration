<x-layouts.admin title="Generate Sitemap">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('admin.tools.sitemap.index') }}">Generate Sitemap</a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card>
                <form action="{{ route('admin.tools.sitemap.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <p>
                                Generate sitemap akan membuat sitemap.xml pada aplikasi ini.
                                <br />
                                Sitemap.xml ini akan digunakan oleh mesin pencari seperti Google, Bing, dan lainnya.
                                <br />
                                <br />
                                Dengan detail sebagai berikut:
                                <br />
                                - Sitemap.xml akan disimpan pada: <code>public/sitemap.xml</code>
                                <br />
                                - Sitemap.xml akan berisi URL dari aplikasi ini.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Buat Sitemap
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
                        text: "Anda akan membuat sitemap.xml pada aplikasi ini.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Lanjutkan!',
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
