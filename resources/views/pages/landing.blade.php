<x-layouts.frontend title="{{ getWebConfiguration()->title }}" description="{{ getWebConfiguration()->description }}">
    <div class="container mt-5">
        <x-frontend.card.hero />
    </div>
    <div class="container py-5" id="competition">
        <h2 class="text-center mb-5" style="color: var(--secondary)">kompetisi</h2>
        <x-frontend.card.competition :competitions="$competitions" />
    </div>
    <div class="container py-5">
        <x-frontend.card.information />
    </div>
    <div id="timeline" class="container py-5">
        <x-frontend.timeline :timelines="$timelines" />
    </div>
    <div id="sponsor" class="container-fluid py-5">
        <h2 class="text-center mb-5 text-white text-uppercase fw-bold">Sponsor</h2>
        <x-frontend.card.sponsor :sponsors="$sponsors" />
    </div>
    <div id="media-partner" class="container-fluid py-5">
        <h2 class="text-center mb-5 text-secondary text-uppercase fw-bold">Media Partner</h2>
        <x-frontend.card.media-partner :partners="$partners" />
    </div>
</x-layouts.frontend>
