<div class="input-group">
    <span class="input-group-text">
        <i class="{{ $input['icon'] }}"></i>
    </span>

    <input type="{{ $input['type'] }}" wire:model.defer="{{ $input['name'] }}" dir="{{ $input['dir'] }}" maxlength="{{ $input['maxlength'] }}"
        name="{{ $input['name'] }}"  class="{{ $input['class'] }}"
        placeholder="{{ $input['placeholder'] }}" />

    @if ($input['name'] == 'phone')
        <span class="input-group-text">+966</span>
    @endif

</div>
<small class="{{ $input['validation'] }}"></small>
