<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#e0f4f5" />
    <title>Medical Portal Dashboard</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        tealbrand: {
                            50: '#effcfc',
                            100: '#d9f5f6',
                            500: '#0f9eaa',
                            600: '#0f828a',
                            700: '#086d76',
                            800: '#075963'
                        }
                    },
                    boxShadow: {
                        soft: '0 18px 50px rgba(8, 89, 99, 0.10)',
                        float: '0 12px 28px rgba(5, 70, 78, 0.12)'
                    }
                }
            }
        };
    </script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .nav-link {
            position: relative;
            transition: background-color .2s ease, color .2s ease, transform .2s ease;
        }

        .nav-link.active {
            color: #0f828a;
            background: #fff;
            box-shadow: 0 8px 24px rgba(3, 70, 77, .10);
        }

        .nav-link>* {
            position: relative;
            z-index: 1;
        }

        .mobile-overlay {
            transition: opacity .2s ease;
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>


<body class="min-h-screen bg-white text-slate-700 antialiased">

    <div class="relative flex h-screen w-full overflow-hidden bg-white">
        <!-- Mobile overlay -->
        <button id="mobileOverlay" class="mobile-overlay fixed inset-0 z-40 hidden bg-slate-950/40 lg:hidden"
            aria-label="Tutup navigasi"></button>

        <!-- Sidebar -->
        @include('components.supplier.sidebar')

        <!-- Main application -->
        <div class="flex h-full flex-1 flex-col overflow-y-auto">
            <!-- Top bar -->
            @include('components.supplier.topbar')

            <!-- Table List -->
            <section
                class="min-w-0 rounded-3xl border border-slate-100 bg-white shadow-[0_8px_35px_rgba(15,23,42,0.04)]">

                @yield('content')

            </section>
        </div>
    </div>

    <script>
        // Render Lucide icons
        lucide.createIcons();

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');
        const menuToggle = document.getElementById('menuToggle');
        const pageTitle = document.getElementById('pageTitle');
        const navLinks = document.querySelectorAll('.nav-link');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-[120%]');
            overlay.classList.remove('hidden');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-[120%]');
            overlay.classList.add('hidden');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        }

        menuToggle.addEventListener('click', () => {
            const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            isOpen ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);

        navLinks.forEach((link) => {
            link.addEventListener('click', () => {
                navLinks.forEach((item) => {
                    item.classList.remove('active');
                    item.classList.add('text-white/80');
                    item.removeAttribute('aria-current');
                });

                link.classList.add('active');
                link.classList.remove('text-white/80');
                link.setAttribute('aria-current', 'page');
                pageTitle.textContent = link.dataset.page;

                // Close drawer after choosing a page on mobile
                if (window.innerWidth < 1024) closeSidebar();
            });
        });

        // Lightweight demo search interaction; connect this to real data later.
        const searchForm = document.getElementById('searchForm');
        const doctorSearch = document.getElementById('doctorSearch');
        searchForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const query = doctorSearch.value.trim();
            if (query) {
                doctorSearch.blur();
                doctorSearch.setAttribute('aria-label', `Search query: ${query}`);
            }
        });

        // Keyboard shortcut: Ctrl/Cmd + K focuses search.
        document.addEventListener('keydown', (event) => {
            if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
                event.preventDefault();
                doctorSearch.focus();
            }
            if (event.key === 'Escape') closeSidebar();
        });

        document.getElementById('year').textContent = new Date().getFullYear();

        // Restore desktop sidebar state when crossing the responsive breakpoint.
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                overlay.classList.add('hidden');
                // sidebar.classList.remove('-translate-x-[120%]');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('overflow-hidden');
            } else if (menuToggle.getAttribute('aria-expanded') !== 'true') {
                sidebar.classList.add('-translate-x-[120%]');
            }
        });
    </script>
</body>

</html>
