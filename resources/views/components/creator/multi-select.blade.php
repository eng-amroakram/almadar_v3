<div class="input-group">
    <span class="input-group-text">
        <i class="{{ $input['icon'] }}"></i>
    </span>
    <select class="{{ $input['class'] }}" id={{$input['id']}} {{ $input['multiple'] }} name="{{ $input['name'] }}"
        @if ($input['search']) data-mdb-filter="true" @endif>
        @foreach ($input['options'] as $key => $option)
            <option value="{{ $option }}">{{ $key }}</option>
        @endforeach
    </select>

</div>
<small class="{{ $input['validation'] }}"></small>
