<div class="dropdown">
    <i class="text-primary  dropdown-toggle" type="button" id="dropdownMenuButton1"
        data-mdb-toggle="dropdown" aria-expanded="false">
        {{ $title }}
    </i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        @foreach ($models as $model)
            <li><a class="dropdown-item" href="#">{{ $model }}</a></li>
        @endforeach
    </ul>
</div>
