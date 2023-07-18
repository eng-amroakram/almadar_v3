<div id="customwidth" class=" {{ $input == 'buyer_id' ? 'col-md-3' : '' }}">
    <select class="select" wire:model="{{ $input }}" data-mdb-filter="true" multiple>
        <option selected hidden></option>
        @foreach ($options as $key => $value)
            <option value="{{ $value }}">{{ $key }}</option>
        @endforeach
    </select>
    <label class="form-label select-label">{{ __("$input") }}</label>
</div>
