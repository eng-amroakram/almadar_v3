@foreach ($checkboxes as $title => $names)
    @if ($title == 'pages')
        <h6>{{ __('pages') }}</h6>
        @foreach ($names as $name)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}" value=""
                        id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
                </div>
            </div>
        @endforeach
    @endif

    @if ($title == 'users')
        <h6 class="mt-3">{{ __('users') }}</h6>
        @foreach ($names as $name)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}"
                        value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
                </div>
            </div>
        @endforeach
    @endif

    @if ($title == 'orders')
        <h6 class="mt-3">{{ __('orders') }}</h6>
        @foreach ($names as $name)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}"
                        value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
                </div>
            </div>
        @endforeach
    @endif

    @if ($title == 'offers')
        <h6 class="mt-3">{{ __('offers') }}</h6>
        @foreach ($names as $name)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}"
                        value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
                </div>
            </div>
        @endforeach
    @endif

    @if ($title == 'sales')
        <h6 class="mt-3">{{ __('sales') }}</h6>
        @foreach ($names as $name)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}"
                        value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
                </div>
            </div>
        @endforeach
    @endif

    @if ($title == 'sms')
        <h6 class="mt-3">{{ __('sms') }}</h6>
        @foreach ($names as $name)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}"
                        value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
                </div>
            </div>
        @endforeach
    @endif
@endforeach
