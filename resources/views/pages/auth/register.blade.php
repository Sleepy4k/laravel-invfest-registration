<x-layouts.auth title="Daftar">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="{{ route('frontend.landing') }}"
                                    class="noble-ui-logo d-block mb-2">{{ $appSettings['title'] }}</a>
                                <h5 class="text-muted fw-normal mb-4">Silahkan isi form berikut untuk mendaftar</h5>
                                <form action="{{ route('register.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <x-input.select name="level" label="Tingkat Kompetisi" id="level">
                                        <option value="">Pilih Tingkat Kompetisi</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}" id="{{ $level->level }}">{{ $level->display_as }}</option>
                                        @endforeach
                                    </x-input.select>

                                    <x-input.select name="competition_id" label="Kompetisi" id="competition_id">
                                        <option value="">Pilih Kompetisi</option>
                                    </x-input.select>
                                    <x-input.text name="team_name" label="Nama Tim" value="{{ old('team_name') }}" />
                                    <x-input.text name="institution" label="Asal Institusi"
                                        value="{{ old('institution') }}" />
                                    <x-input.text name="leader_name" label="Nama Ketua"
                                        value="{{ old('leader_name') }}" />
                                    <x-input.text name="leader_phone" label="Nomor Telepon Ketua"
                                        value="{{ old('leader_phone') }}" />
                                    <x-input.file name="leader_card" label="Kartu Identitas Ketua"
                                        value="{{ old('leader_card') }}" />
                                    <x-input.text name="companion_name" label="Nama Pendamping (Hanya untuk SMA/SMK)" id="companion_name"
                                        value="{{ old('companion_name') }}" />
                                    <x-input.file name="companion_card" label="Kartu Identitas Pendamping (Hanya untuk SMA/SMK)"
                                        id="companion_card" />
                                    <x-input.text name="email" label="Email Ketua" type="email"
                                        value="{{ old('email') }}" />
                                    <span style="color: red; font-weight: bold; font-style: italic; padding: 0 4px;">* Pastikan menggunakan email pribadi</span>
                                    <x-input.text name="password" label="Password" type="password" />
                                    <x-input.text name="password_confirmation" label="Konfirmasi Password"
                                        type="password" />
                                    <x-button.primary class="w-100 mb-3" type="submit" id="btn-submit">
                                        Daftar Tim
                                    </x-button.primary>
                                    <a href="{{ route('login') }}">
                                        <x-button.primary-outline class="w-100 mb-3" type="button">
                                            Masuk
                                        </x-button.primary-outline>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @pushOnce('custom-scripts')
        <script>
            $('#companion_name').parent().hide();
            $('#companion_card').parent().hide();

            $('#level').change(function() {
                if ($(this).find('option:selected')?.attr('id')?.toLowerCase() === 'umum') {
                    $('#companion_name').parent().show();
                    $('#companion_card').parent().show();
                } else {
                    $('#companion_name').parent().hide();
                    $('#companion_card').parent().hide();
                }
            });

            $('#btn-submit').click(function() {
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                );
            });

            $('#level').change(function() {
                var selectedLevelId = $(this).val();
                var competitionSelect = $('#competition_id');

                competitionSelect.empty();
                competitionSelect.append('<option value="">Pilih Kompetisi</option>');

                if (selectedLevelId) {
                    $.ajax({
                        url: '{{ route("frontend.competition.index") }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            level: selectedLevelId,
                            platform: '{{ config("app.url") }}'
                        },
                        success: function(result) {
                            result.competitions.forEach(function(competition) {
                                competitionSelect.append('<option value="' + competition.id + '">' + competition.name + '</option>');
                            });
                        }
                    });
                }
            });
        </script>
    @endPushOnce
</x-layouts.auth>
