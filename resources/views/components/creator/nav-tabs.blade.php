<ul class="nav md-tabs tabs-2" role="tablist" style="background-color: rgb(139, 107, 75);">
    @foreach ($tabs as $tab)
        <li class="nav-item">
            <a class="nav-link {{ $tab['status'] }} {{ $tab['id'] . '-' . 'creator-nav' }} nav-link-custom-creator"
                data-toggle="tab" href="#{{ $tab['id'] }}" role="tab">
                <i class="{{ $tab['icon'] }} mr-1"></i>
                {{ $tab['title'] }}
            </a>
        </li>
    @endforeach
</ul>
