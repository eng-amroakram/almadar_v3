<div class="tab-pane fade in {{ $content['status'] }} nav-tabs-custom-creator {{ $content['id'] . '-' . 'creator-tap' }}"
    id="{{ $content['id'] }}" role="tabpanel">

    <div class="modal-body">
        @if ($size == 'modal-lg' || $size == 'modal-xl')
            <div class="row">
                @foreach ($content['inputs'] as $input)
                    <x-creator.inputs :input="$input" :classsize="'col-md-6'" :size="$size" :creatorid="$creatorid">
                    </x-creator.inputs>
                @endforeach
            </div>
        @endif

        @if ($size == '')
            @foreach ($content['inputs'] as $input)
                <x-creator.inputs :input="$input" :classsize="'col-md-12'" :size="$size" :creatorid="$creatorid">
                </x-creator.inputs>
            @endforeach
        @endif
    </div>

    <div class="modal-footer">

        <button type="button" class="btn bg-brown-color" data-mdb-dismiss="modal">
            إغلاق
        </button>

        @if ($content['prev'])
            <button type="button" class="btn bg-brown-color nextCreator"
                tapcreatorid="{{ $content['prev'] }}">السابق</button>
        @endif

        <button type="button" class="btn text-white brown-color {{ $creatorbuttong }}">حفظ</button>

        @if ($content['next'])
            <button type="button" class="btn bg-brown-color nextCreator"
                tapcreatorid="{{ $content['next'] }}">التالي</button>
        @endif

    </div>
</div>
