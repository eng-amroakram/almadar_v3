<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="./img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/mdb.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="lib/select/css/mdb.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/select.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/new-prism.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/modals.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/switch.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/timeline.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('mdb/css/datepicker.css') }}" />


    <!-- PRISM -->
    <!-- Custom styles -->
    <style></style>
</head>

<body>
    <div class="container my-5">


        <div id="customremoveinputgroup" class="input-group p-0 mb-3" wire:ignore>
            <div id="customwidth">
                <!--Section: Demo-->
                <div class="form-outline datepicker">
                    <input type="text" class="form-control form-icon-trailing" id="exampleDatepicker1">
                    <label for="exampleDatepicker1" class="form-label" style="margin-left: 0px;">Example label</label>
                    <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 87.2px;"></div>
                        <div class="form-notch-trailing"></div>
                    </div>
                    <button id="datepicker-toggle-673138" type="button" class="datepicker-toggle-button"
                        data-mdb-toggle="datepicker">
                        <i class="far fa-calendar datepicker-toggle-icon"></i>
                    </button>
                </div>
            </div>
        </div>



        <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script>

</body>

</html>
