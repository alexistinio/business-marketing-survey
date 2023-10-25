<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="winter">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mark IT</title>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @stack('css')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-100">
            <div>
                
                @include('layouts.partials.topnavigation')
            </div>
            <div class="flex flex-col md:flex-row sm:flex-col">
                <div>    
                    @include('layouts.partials.sidenavigation')
                </div>
                <main class="w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
     
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <script>
            
        window.ckeditor = ClassicEditor;
        window.Pikaday = Pikaday;
        </script>
        @stack('js')
        <script type="text/javascript">
   
            (function() {

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

                document.addEventListener('livewire:load', (e) => {

                    let is_away = "{{ request()->routeIs('message') }}";
                    
                
                    window.Echo.channel('message-notification')
                    .listen('.message-notification', (event) => {
                        if(!is_away) {
                            let badge_container = document.getElementById('new-messages');
                            let old_value = badge_container.firstChild ? badge_container.firstChild.textContent : 0;
                            let new_value = parseInt(old_value) + 1;

                            badge_container.innerHTML = "<span class='badge badge-primary badge-sm'>"+new_value+"</span>";
                        }
                        else
                        {

                            let in_message_visible = document.getElementById('user-to-wrapper');
                            
                            if(!in_message_visible) {
                                let user_badge_el = document.querySelector('.user-message-badge[data-id="'+(event.user_from ?? event.user).id+'"]');
                                let old_value = parseInt(user_badge_el.firstChild ? user_badge_el.firstChild.textContent : 0);
                                let new_value = old_value + 1;
                                user_badge_el.innerHTML = "<span class='badge badge-primary badge-sm'>"+new_value+"</span>";
                            }
                            else
                            {
                                let current_opened_user = in_message_visible.dataset.id;
                                
                                if(parseInt(current_opened_user) != parseInt(event.user_from.id)) {
                                    let user_badge_el = document.querySelector('.user-message-badge[data-id="'+(event.user_from ?? event.user).id+'"]');
                                    let old_value = parseInt(user_badge_el.firstChild ? user_badge_el.firstChild.textContent : 0);
                                    let new_value = old_value + 1;
                                    user_badge_el.innerHTML = "<span class='badge badge-primary badge-sm'>"+new_value+"</span>";
                                }
                                else
                                {
                                    // update read_at
                                }
                            }
                        }
                    });
                });



            })();
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
