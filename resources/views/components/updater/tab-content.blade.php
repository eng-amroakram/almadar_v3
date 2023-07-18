<div class="tab-pane fade in {{ $content['status'] }} nav-tabs-custom-updater {{ $content['id'] . '-' . 'updater-tap' }}"
    id="{{ $content['id'] . '-updater' }}" role="tabpanel">

    <div class="modal-body">
        @if ($size == 'modal-lg' || $size == 'modal-xl')
            <div class="row">
                @foreach ($content['inputs'] as $input)
                    <x-updater.inputs :input="$input" :classsize="'col-md-6'"  :size="$size" :updaterid="$updaterid"></x-updater.inputs>
                @endforeach
            </div>
        @endif

        @if ($size == '')
            @foreach ($content['inputs'] as $input)
                <x-updater.inputs :input="$input" :classsize="'col-md-12'" :size="$size"  :updaterid="$updaterid">
                </x-updater.inputs>
            @endforeach
        @endif
    </div>

    <div class="modal-footer">

        <button type="button" class="btn bg-brown-color" data-mdb-dismiss="modal">
            إغلاق
        </button>

        @if ($content['prev'])
            <button type="button" class="btn bg-brown-color nextUpdater"
                tapupdaterid="{{ $content['prev'] }}">السابق</button>
        @endif

        <button type="button" class="btn text-white brown-color {{ $updaterbuttong }}">تحديث</button>

        @if ($content['next'])
            <button type="button" class="btn bg-brown-color nextUpdater"
                tapupdaterid="{{ $content['next'] }}">التالي</button>
        @endif

    </div>
</div>
