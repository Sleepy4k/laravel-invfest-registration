<x-layouts.admin title="Konfigurasi Web">
    @push('style')
        <style>
            #color-picker-primary {
                width: 100%;
                height: 200px;
                border-radius: 5px;
                background: {{ $settings['primary_color'] }};
            }

            #color-picker-secondary {
                width: 100%;
                height: 200px;
                border-radius: 5px;
                background: {{ $settings['secondary_color'] }};
            }
        </style>
    @endpush

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
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Konfigurasi">
                <form action="{{ route('admin.website-configuration.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <h5 class="mb-3">Konfigurasi Umum</h5>
                            <x-input.text name="title" label="Title Website" value="{{ $settings['title'] }}" />
                            <x-input.text name="slogan" label="Slogan Website"
                                value="{{ $settings['slogan'] }}" />
                            <x-input.text name="heading" label="Heading Website"
                                value="{{ $settings['heading'] }}" />
                            <x-input.textarea name="description" label="Deskripsi Website"
                                value="{{ $settings['description'] }}" />
                            <img src="{{ asset($settings['nav_logo']) }}" alt="{{ $settings['title'] }}"
                                class="img-fluid mb-3" id="nav_logo_image" width="100">
                            <x-input.file name="nav_logo" label="Logo Navigasi"
                                value="{{ $settings['nav_logo'] }}" id="nav_logo" />
                            <h5 class="mb-3">Konfigurasi Kontak</h5>
                            <x-input.text name="phone" label="Nomor Telepon"
                                value="{{ $settings['phone'] }}" />
                            <x-input.text name="instagram" label="Instagram"
                                value="{{ $settings['instagram'] }}" />
                            <x-input.text name="video_tutorial" label="Video Tutorial"
                                value="{{ $settings['video_tutorial'] }}" />
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <h5 class="mb-3">Konfigurasi Event</h5>
                            <x-input.datetime name="deadline" label="Deadline Event"
                                value="{{ $settings['deadline'] }}" />
                            <img src="{{ asset($settings['twibbon']) }}" alt="{{ $settings['title'] }}"
                                class="img-fluid mb-3" width="200" id="twibbon_image">
                            <x-input.file name="twibbon" label="Twibbon Event" value="{{ $settings['twibbon'] }}"
                                id="twibbon" />
                            <x-input.text name="twibbon_link" label="Link Twibbon"
                                value="{{ $settings['twibbon_link'] }}" />
                            <img src="{{ asset($settings['mascot']) }}" alt="{{ $settings['title'] }}"
                                class="img-fluid mb-3" width="200" id="mascot_image">
                            <x-input.file name="mascot" label="Mascot Event" value="{{ $settings['mascot'] }}"
                                id="mascot" />
                            <h5 class="mb-3">Konfigurasi Tema</h5>
                            <div id="color-picker-primary" class="mb-3"></div>
                            <x-input.text name="primary_color" label="Warna Utama"
                                value="{{ $settings['primary_color'] }}" id="primary_color" />
                            <div id="color-picker-primary-hover" class="mb-3"></div>
                            <x-input.text name="primary_color_hover" label="Warna Utama Hover"
                                value="{{ $settings['primary_color_hover'] }}" id="primary_color_hover" />
                            <div id="color-picker-secondary" class="mb-3"></div>
                            <x-input.text name="secondary_color" label="Warna Sekunder"
                                value="{{ $settings['secondary_color'] }}" id="secondary_color" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>

    @push('custom-scripts')
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

            $('#secondary_color').on('keyup', function() {
                $('#color-picker-secondary').css('background', $(this).val());
            });
        </script>
    @endpush
</x-layouts.admin>
