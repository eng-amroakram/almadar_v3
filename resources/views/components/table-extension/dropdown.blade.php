<td>
    <div class="dropdown">
        <i class="text-primary fas fa-eye dropdown-toggle" type="button" id="dropdownMenuButton1" data-mdb-toggle="dropdown"
            aria-expanded="false">
            الفروع
        </i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            @foreach ($models as $model)
                <li><a class="dropdown-item" href="#">{{ $model['name'] }}</a></li>
            @endforeach
        </ul>
    </div>
</td>
