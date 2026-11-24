@if (session('text') && session('title') && session('icon'))
    <script>
        (function () {
            if (typeof Swal === 'undefined') return;
            Swal.fire({
                title: @json(session('title')),
                text: @json(session('text')),
                icon: @json(session('icon')),
                confirmButtonColor: '#15803D',
                confirmButtonText: 'OK',
                timer: @json(session('icon') === 'success' ? 3500 : null),
                timerProgressBar: @json(session('icon') === 'success')
            });
        })();
    </script>
@endif
