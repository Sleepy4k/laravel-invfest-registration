<div class="row my-5">
    <div class="col-md-12">
        <h2
            data-aos="fade-up"
            style="color: var(--secondary)"
            class="text-center mb-5 text-uppercase fw-bold"
        >
            {{ sprintf('%s Timelines', $appSettings['title']) }}
        </h2>
        <div id="content_timeline">
            <ul class="timeline mx-auto">
                @foreach ($timelines as $timeline)
                    <li
                        class="card event"
                        data-aos="fade-up"
                        data-aos-delay="150"
                        data-date="{{ date('d M Y', strtotime($timeline?->date)) }}"
                    >
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
