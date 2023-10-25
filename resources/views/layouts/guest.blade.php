<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="emerald">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mark IT</title>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @stack('css')
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('js')
        <script>
            window.addEventListener('swal', function (e) {
                Swal.fire(e.detail);
            });

            window.addEventListener('swal_warning', function (e) {
                let event = e.detail.onConfirm
                let params = e.detail.params

                delete e.detail.onConfirm
                delete e.detail.params

                Swal.fire(e.detail).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit(event, params)
                    }
                });
            });
        </script>
        @if(session()->has('swal'))
            <script>
                (function() {
                    Swal.fire({
                    'icon': '{{ session('swal')['icon'] }}',
                        'title': '{{ session('swal')['title'] }}',
                        'text': '{{ session('swal')['text'] }}',
                        'showCancelButton' : '{{ session('swal')['showCancelButton'] }}',
                        'showConfirmButton' : '{{ session('swal')['showConfirmButton'] }}',
                        'timerProgressBar' : '{{ session('swal')['timerProgressBar'] }}'
                    });
                })();
                
            </script>
        @endif
    </body>
</html>
