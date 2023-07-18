<label class="form-label select-label"><strong>{{ $input['lable'] }}</strong></label>
<div class="col-md-12 input-group">
    <span class="input-group-text">
        <i class="{{ $input['icon'] }}"></i>
    </span>
    <select id="{{ $input['id'] }}"
        @if ($input['defer']) wire:model.defer="{{ $input['name'] }}" @else wire:model="{{ $input['name'] }}" @endif
        class="{{ $input['class'] }}" name="{{ $input['name'] }}"
        @if ($input['search']) data-mdb-container="#{{ $creatorid }}" data-mdb-filter="true" @endif>
        @foreach ($input['options'] as $key => $option)
            <option value="{{ $option }}">{{ $key }}
            </option>
        @endforeach
    </select>

</div>
<small class="{{ $input['validation'] }}"></small>
