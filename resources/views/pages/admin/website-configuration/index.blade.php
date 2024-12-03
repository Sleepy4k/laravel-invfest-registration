<x-layouts.admin title="Konfigurasi Web">
    @pushOnce('style')
        <style>
            #color-picker-primary {
                width: 100%;
                height: 200px;
                border-radius: 5px;
                background: {{ $settings['primary_color'] }};
            }

            #color-picker-primary-hover {
                width: 100%;
                height: 200px;
                border-radius: 5px;
                background: {{ $settings['primary_color_hover'] }};
            }

            #color-picker-secondary {
                width: 100%;
                height: 200px;
                border-radius: 5px;
                background: {{ $settings['secondary_color'] }};
            }

            #color-picker-secondary-hover {
                width: 100%;
                height: 200px;
                border-radius: 5px;
                background: {{ $settings['secondary_color_hover'] }};
            }
        </style>
    @endPushOnce

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.website-configuration.index') }}">Manajemen Website</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Konfigruasi</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab">
                <li class="nav-item me-1">
                    <a
                        href="#konfigurasi-umum"
                        class="nav-link active"
                        data-bs-toggle="tab"
                    >
                        Konfigurasi Umum
                    </a>
                </li>
                <li class="nav-item me-1">
                    <a
                        href="#konfigurasi-event"
                        class="nav-link"
                        data-bs-toggle="tab"
                    >
                        Konfigurasi Event
                    </a>
                </li>
                <li class="nav-item me-1">
                    <a
                        href="#konfigurasi-lainnya"
                        class="nav-link"
                        data-bs-toggle="tab"
                    >
                        Konfigurasi Lainnya
                    </a>
                </li>
                <li class="nav-item me-1">
                    <a
                        href="#konfigurasi-tema"
                        class="nav-link"
                        data-bs-toggle="tab"
                    >
                        Konfigurasi Tema
                    </a>
                </li>
            </ul>
        </div>

        <form action="{{ route('admin.website-configuration.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="tab-content">
                <div class="tab-pane fade show active" id="konfigurasi-umum">
                    <x-admin.card title="Konfigurasi Umum">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <x-input.text
                                    name="title"
                                    label="Title Website"
                                    value="{{ $settings['title'] }}"
                                />
                                <x-input.text
                                    name="slogan"
                                    label="Slogan Website"
                                    value="{{ $settings['slogan'] }}"
                                />
                                <x-input.textarea
                                    name="heading"
                                    label="Heading Website"
                                    value="{{ $settings['heading'] }}"
                                />
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <img
                                    alt="{{ $settings['title'] }}"
                                    class="img-fluid mb-3"
                                    src="{{ asset($settings['nav_logo'] ?? '#') }}"
                                    id="nav_logo_image" width="100"
                                />
                                <x-input.file
                                    name="nav_logo"
                                    label="Logo Navigasi"
                                    value="{{ $settings['nav_logo'] }}"
                                    id="nav_logo"
                                />
                                <x-input.textarea
                                    name="description"
                                    label="Deskripsi Website"
                                    value="{{ $settings['description'] }}"
                                />
                            </div>
                        </div>
                    </x-admin.card>
                </div>
                <div class="tab-pane fade" id="konfigurasi-event">
                    <x-admin.card title="Konfigurasi Event">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <img
                                    src="{{ asset($settings['twibbon'] ?? '#') }}"
                                    alt="{{ $settings['title'] }}"
                                    class="img-fluid mb-3"
                                    width="200"
                                    id="twibbon_image"
                                />
                                <x-input.file
                                    name="twibbon"
                                    label="Twibbon Event"
                                    value="{{ $settings['twibbon'] }}"
                                    id="twibbon"
                                />
                                <x-input.datetime
                                    name="deadline"
                                    label="Deadline Event"
                                    value="{{ $settings['deadline'] }}"
                                />
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <img
                                    src="{{ asset($settings['mascot'] ?? '#') }}"
                                    alt="{{ $settings['title'] }}"
                                    class="img-fluid mb-3"
                                    width="200"
                                    id="mascot_image"
                                />
                                <x-input.file
                                    name="mascot"
                                    label="Mascot Event"
                                    value="{{ $settings['mascot'] }}"
                                    id="mascot"
                                />
                                <x-input.text
                                    name="twibbon_link"
                                    label="Link Twibbon"
                                    value="{{ $settings['twibbon_link'] }}"
                                />
                            </div>
                        </div>
                    </x-admin.card>
                </div>
                <div class="tab-pane fade" id="konfigurasi-lainnya">
                    <x-admin.card title="Konfigurasi Lainnya">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <x-input.text
                                    name="phone"
                                    label="Nomor Telepon"
                                    value="{{ $settings['phone'] }}"
                                />
                                <x-input.text
                                    name="instagram"
                                    label="Instagram"
                                    value="{{ $settings['instagram'] }}"
                                />
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <x-input.text
                                    name="video_tutorial"
                                    label="Video Tutorial"
                                    value="{{ $settings['video_tutorial'] }}"
                                />
                            </div>
                        </div>
                    </x-admin.card>
                </div>
                <div class="tab-pane fade" id="konfigurasi-tema">
                    <x-admin.card title="Konfigurasi Tema">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="color-picker-primary" class="mb-3"></div>
                                <x-input.text
                                    name="primary_color"
                                    label="Warna Utama"
                                    value="{{ $settings['primary_color'] }}"
                                    id="primary_color"
                                />
                                <div id="color-picker-primary-hover" class="mb-3"></div>
                                <x-input.text
                                    name="primary_color_hover"
                                    label="Warna Utama Hover"
                                    value="{{ $settings['primary_color_hover'] }}"
                                    id="primary_color_hover"
                                />
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="color-picker-secondary" class="mb-3"></div>
                                <x-input.text
                                    name="secondary_color"
                                    label="Warna Sekunder"
                                    value="{{ $settings['secondary_color'] }}"
                                    id="secondary_color"
                                />
                                <div id="color-picker-secondary-hover" class="mb-3"></div>
                                <x-input.text
                                    name="secondary_color_hover"
                                    label="Warna Sekunder Hover"
                                    value="{{ $settings['secondary_color_hover'] }}"
                                    id="secondary_color_hover"
                                />
                            </div>
                        </div>
                    </x-admin.card>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    Update Konfigurasi
                </button>
            </div>
        </form>
    </div>

    @pushOnce('custom-scripts')
        <script>
            $('#nav_logo').on('change', function() {
                const file = $(this).get(0).files[0];
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    $('#nav_logo_image').attr('src', reader.result);
                }
            });

            $('#footer_logo').on('change', function() {
                const file = $(this).get(0).files[0];
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    $('#footer_logo_image').attr('src', reader.result);
                }
            });

            $('#twibbon').on('change', function() {
                const file = $(this).get(0).files[0];
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    $('#twibbon_image').attr('src', reader.result);
                }
            });

            $('#mascot').on('change', function() {
                const file = $(this).get(0).files[0];
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    $('#mascot_image').attr('src', reader.result);
                }
            });

            $('#primary_color').on('keyup', function() {
                $('#color-picker-primary').css('background', $(this).val());
            });

            $('#primary_color_hover').on('keyup', function() {
                $('#color-picker-primary-hover').css('background', $(this).val());
            });

            $('#secondary_color').on('keyup', function() {
                $('#color-picker-secondary').css('background', $(this).val());
            });

            $('#secondary_color_hover').on('keyup', function() {
                $('#color-picker-secondary-hover').css('background', $(this).val());
            });
        </script>
    @endPushOnce
</x-layouts.admin>
