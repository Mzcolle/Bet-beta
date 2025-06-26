<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @php 
            // Modificado para retornar array vazio se null
            $setting = \Helper::getSetting() ?? [];
            $custom = \Helper::getCustom() ?? [];
        @endphp

        @if(!empty($setting['software_favicon'] ?? null))
            <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/storage/' . $setting['software_favicon']) }}">
        @endif

        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100&display=swap" rel="stylesheet">
        <title>{{ env('APP_NAME') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            body {
                font-family: {{ $custom['font_family_default'] ?? "'Roboto Condensed', sans-serif" }};
            }
            :root {
                --ci-primary-color: {{ $custom['primary_color'] ?? '#6366f1' }};
                --ci-primary-opacity-color: {{ $custom['primary_opacity_color'] ?? 'rgba(99, 102, 241, 0.1)' }};
                --ci-secundary-color: {{ $custom['secundary_color'] ?? '#8b5cf6' }};
                --ci-gray-dark: {{ $custom['gray_dark_color'] ?? '#1f2937' }};
                --ci-gray-light: {{ $custom['gray_light_color'] ?? '#f3f4f6' }};
                --ci-gray-medium: {{ $custom['gray_medium_color'] ?? '#9ca3af' }};
                --ci-gray-over: {{ $custom['gray_over_color'] ?? '#374151' }};
                --title-color: {{ $custom['title_color'] ?? '#111827' }};
                --text-color: {{ $custom['text_color'] ?? '#374151' }};
                --sub-text-color: {{ $custom['sub_text_color'] ?? '#6b7280' }};
                --placeholder-color: {{ $custom['placeholder_color'] ?? '#9ca3af' }};
                --background-color: {{ $custom['background_color'] ?? '#ffffff' }};
                --standard-color: #1C1E22;
                --shadow-color: #111415;
                --page-shadow: linear-gradient(to right, #111415, rgba(17, 20, 21, 0));
                --autofill-color: #f5f6f7;
                --yellow-color: #FFBF39;
                --yellow-dark-color: #d7a026;
                --border-radius: {{ $custom['border_radius'] ?? '6px' }};
                /* ... outras variáveis CSS com valores padrão ... */
                
                --input-primary: {{ $custom['input_primary'] ?? '#ffffff' }};
                --input-primary-dark: {{ $custom['input_primary_dark'] ?? '#1f2937' }};

                --carousel-banners: {{ $custom['carousel_banners'] ?? '#f3f4f6' }};
                --carousel-banners-dark: {{ $custom['carousel_banners_dark'] ?? '#1f2937' }};

                --sidebar-color: {{ $custom['sidebar_color'] ?? '#ffffff' }} !important;
                --sidebar-color-dark: {{ $custom['sidebar_color_dark'] ?? '#111827' }} !important;

                --navtop-color: {{ $custom['navtop_color'] ?? '#ffffff' }};
                --navtop-color-dark: {{ $custom['navtop_color_dark'] ?? '#111827' }};

                --side-menu: {{ $custom['side_menu'] ?? '#f3f4f6' }};
                --side-menu-dark: {{ $custom['side_menu_dark'] ?? '#1f2937' }};

                --footer-color: {{ $custom['footer_color'] ?? '#f3f4f6' }};
                --footer-color-dark: {{ $custom['footer_color_dark'] ?? '#111827' }};

                --card-color: {{ $custom['card_color'] ?? '#ffffff' }};
                --card-color-dark: {{ $custom['card_color_dark'] ?? '#1f2937' }};
            }

            .navtop-color {
                background-color: {{ $custom['sidebar_color'] ?? '#ffffff' }} !important;
            }
            :is(.dark .navtop-color) {
                background-color: {{ $custom['sidebar_color_dark'] ?? '#111827' }} !important;
            }

            .bg-base {
                background-color: {{ $custom['background_base'] ?? '#f3f4f6' }};
            }
            :is(.dark .bg-base) {
                background-color: {{ $custom['background_base_dark'] ?? '#111827' }};
            }
        </style>

        @if(!empty($custom['custom_css'] ?? null))
            <style>
                {!! $custom['custom_css'] !!}
            </style>
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body color-theme="dark" class="bg-base text-gray-800 dark:text-gray-300 ">
        <div id="viperpro"></div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
        <script>
            window.Livewire?.on('copiado', (texto) => {
                navigator.clipboard.writeText(texto).then(() => {
                    Livewire.emit('copiado');
                });
            });

            window._token = '{{ csrf_token() }}';
            
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.remove('dark')
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light')
                document.documentElement.classList.add('dark')
            }
        </script>

        @if(!empty($custom['custom_js'] ?? null))
            <script>
                {!! $custom['custom_js'] !!}
            </script>
        @endif
    </body>
</html>