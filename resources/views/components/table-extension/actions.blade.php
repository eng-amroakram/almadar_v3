<td>
    <div class="d-flex justify-content-center">

        @foreach ($buttons as $button)
            @can("delete$classtitle", [$classmodel, $id])
                @if ($button == 'delete')
                    <a type="button" class="btn-sm text-danger fa-lg me-2 ms-2" wire:click='delete({{ $id }})'
                        modelid="{{ $id }}" title="Delete">
                        <i class="fas fa-trash-can"></i>
                    </a>
                @endif
            @endcan

            @can("update$classtitle", [$classmodel, $id])
                @if ($button == 'edit')
                    @if ($page)
                        <a type="button" class="btn-sm text-primary fa-lg me-2 ms-2" href="{{ edit_table($table, $id) }}"
                            modelid="{{ $id }}" title="Edit">
                            <i class="far fa-pen-to-square"></i>
                        </a>
                    @endif

                    @if (!$page)
                        <a type="button" class="btn-sm text-primary fa-lg me-2 ms-2" wire:click='edit({{ $id }})'
                            data-mdb-toggle="modal" data-mdb-target="#{{ $updaterid }}" href="#{{ $table . '-' . $id }}"
                            modelid="{{ $id }}" title="Edit">
                            <i class="far fa-pen-to-square"></i>
                        </a>
                    @endif
                @endif
            @endcan

            @can("view$classtitle", [$classmodel, $id])
                @if ($button == 'show')
                    <a type="button" class="btn-sm text-primary fa-lg me-2 ms-2" href="#modelid"
                        wire:click="show({{ $id }})" modelid="{{ $id }}" title="Show">
                        <i class="fas fa-eye"></i>
                    </a>
                @endif
            @endcan

            @if ($button == 'print')
                <a type="button" class="btn-sm text-primary fa-lg me-2 ms-2" href="#modelid"
                    wire:click="print({{ $id }})" modelid="{{ $id }}" title="Print">
                    <i class="fas fa-print"></i>
                </a>
            @endif

            @if ($button == 'download')
                <a type="button" class="btn-sm text-danger fa-lg me-2 ms-2" href="#modelid"
                    wire:click="download({{ $id }})" modelid="{{ $id }}" title="Download">
                    <i class="fas fa-download"></i>
                </a>
            @endif
        @endforeach

    </div>
</td>
