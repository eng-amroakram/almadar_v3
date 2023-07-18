<ul class="nav md-tabs tabs-2" role="tablist" style="background-color: rgb(139, 107, 75);">
    @foreach ($tabs as $tab)
        <li class="nav-item">
            <a class="nav-link {{ $tab['status'] }} {{ $tab['id'] . '-' . 'updater-nav' }} nav-link-custom-updater"
                data-toggle="tab" href="#{{ $tab['id'] . '-updater' }}" role="tab">
                <i class="{{ $tab['icon'] }} mr-1"></i>
                {{ $tab['title'] }}
            </a>
        </li>
    @endforeach
</ul>
