<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Citiis'Go — Wisata Alam Galunggung")</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#1D9E75',
                            dark: '#0F6E56',
                            light: '#E1F5EE',
                            mid: '#5DCAA7',
                        }
                    },
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    {{-- Tabler Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        #navbar {
            transition: all .3s ease;
        }

        @keyframes bounce-y {

            0%,
            100% {
                transform: translateX(-50%) translateY(0)
            }

            50% {
                transform: translateX(-50%) translateY(8px)
            }
        }

        .hero-scroll {
            animation: bounce-y 2s infinite;
        }

        .img-zoom {
            transition: transform .45s ease;
        }

        .group:hover .img-zoom {
            transform: scale(1.06);
        }

        .card-lift {
            transition: transform .25s, box-shadow .25s;
        }

        .card-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 48px rgba(0, 0, 0, .13);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    @include('components.navbar')

    <main>@yield('content')</main>

    @include('components.footer')

    <script>
        // Navbar: transparan di hero, putih saat scroll
        const nb = document.getElementById('navbar');
        const onScroll = () => {
            const scrolled = window.scrollY > 60;
            nb.classList.toggle('bg-white/95', scrolled);
            nb.classList.toggle('backdrop-blur-md', scrolled);
            nb.classList.toggle('shadow-[0_1px_0_#E5E7EB]', scrolled);
            nb.classList.toggle('py-3', scrolled);
            nb.classList.toggle('py-5', !scrolled);
            // Link warna
            document.querySelectorAll('.nav-link').forEach(a => {
                a.classList.toggle('text-white/80', !scrolled);
                a.classList.toggle('text-gray-600', scrolled);
            });
            // Logo teks
            document.querySelectorAll('.logo-text').forEach(a => {
                a.classList.toggle('text-white', !scrolled);
                a.classList.toggle('text-brand-dark', scrolled);
            });
            // Btn login
            document.querySelectorAll('.btn-login').forEach(a => {
                a.classList.toggle('bg-white/15', !scrolled);
                a.classList.toggle('border-white/40', !scrolled);
                a.classList.toggle('text-white', !scrolled);
                a.classList.toggle('bg-transparent', scrolled);
                a.classList.toggle('border-brand', scrolled);
                a.classList.toggle('text-brand', scrolled);
            });
        };
        window.addEventListener('scroll', onScroll);
        onScroll();

        // Mobile menu toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    </script>

    @stack('scripts')
</body>

</html>
