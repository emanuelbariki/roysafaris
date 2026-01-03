@if (session()->get('flash_success'))
    <script>
        $(document).ready(function () {
            swalInit.fire({
                title: 'Success',
                text: "{!! session()->get('flash_success') !!}",
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                timer: 4000
            });
        });
    </script>
@endif

@if (session()->get('flash_warning'))
    <script>
        $(document).ready(function () {
            swalInit.fire({
                title: 'Warning',
                text: "{!! session()->get('flash_warning') !!}",
                icon: 'warning',
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                timer: 5000
            });
        });
    </script>
@endif

@if (session()->get('flash_info'))
    <script>
        $(document).ready(function () {
            swalInit.fire({
                title: 'Information',
                text: "{!! session()->get('flash_info') !!}",
                icon: 'info',
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                timer: 4000
            });
        });
    </script>
@endif

@if (session()->get('flash_danger'))
    <script>
        $(document).ready(function () {
            swalInit.fire({
                title: 'Error',
                text: "{!! session()->get('flash_danger') !!}",
                icon: 'error',
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                timer: 6000
            });
        });
    </script>
@endif

@if (session()->get('flash_error'))
    <script>
        $(document).ready(function () {
            swalInit.fire({
                title: 'Error',
                text: "{!! session()->get('flash_error') !!}",
                icon: 'error',
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                timer: 6000
            });
        });
    </script>
@endif
