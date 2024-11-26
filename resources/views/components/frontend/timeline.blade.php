<div class="row my-5">
    <div class="col-md-12">
        <h2 class="text-center mb-5 text-uppercase fw-bold" style="color: var(--secondary)">
            {{ sprintf('%s Timelines', $appSettings['title']) }}</h2>
        <div id="content_timeline">
            <ul class="timeline mx-auto">
                @foreach ($timelines as $timeline)
                    <li class="card event" data-date="{{ date('d M Y', strtotime($timeline?->date)) }}">
                        <div class="wrap_info">
                            <h3>{{ $timeline?->title }}</h3>
                            <p>{{ $timeline?->description }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
