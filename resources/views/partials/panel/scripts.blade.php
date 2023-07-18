<!-- Font Awesome Key -->
<script src="https://kit.fontawesome.com/2e7f7cf12b.js" crossorigin="anonymous"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/js/new-prism.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/mdbsnippet.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script> --}}

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>

@livewireScripts()
<script>
    $(document).ready(function() {
        var myDiv = document.getElementById('customremoveinputgroup');
        var containerDiv = document.getElementById('removecontainerpadding');
        if (window.innerWidth <= 767) {
            myDiv.classList.remove('input-group');
        } else {
            myDiv.classList.add('input-group');
        }

        window.addEventListener('resize', function() {
            var myDiv = document.getElementById('customremoveinputgroup');
            var containerDiv = document.getElementById('removecontainerpadding');
            if (window.innerWidth <= 767) {
                myDiv.classList.remove('input-group');
            } else {
                myDiv.classList.add('input-group');
            }
        });

    });
</script>
@livewire('auth')
@stack('login_register_script')
@stack('users')

{{-- Forms --}}

{{-- Users --}}
@stack('create-user-scripts')
@stack('update-user-scripts')

{{-- Creator Models --}}
@stack('creator')
@stack('updater')
@stack('creator-reservation')
@stack('pdf-service')
