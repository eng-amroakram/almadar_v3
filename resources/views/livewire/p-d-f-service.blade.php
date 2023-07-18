<div>
    <iframe id="{{ $pdf_id }}" src="{{ $file }}" width="100%" height="570px">
    </iframe>



    @push('pdf-service')
        <script>
            Livewire.on('set-pdf-file', function(path, id) {
                $(id).attr('src', path);
                console.log('Ok');
                console.log('Ok');
                console.log('Ok');
                console.log('Ok');
                console.log(id);
                console.log(id);
                console.log(id);
                console.log(path);
            });
        </script>
    @endpush

</div>
