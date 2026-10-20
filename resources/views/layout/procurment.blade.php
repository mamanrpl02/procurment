<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Layout</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        app: {
                            bg: '#f7f8f7',
                            border: '#e7e9e7',
                            green: '#15803d',
                            greenLight: '#eaf7ee',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        html,
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Hide scrollbar but keep scrolling */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Small, subtle scrollbar for desktop */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5d1;
            border-radius: 999px;
        }

        .sidebar-transition {
            transition: transform 260ms ease, width 260ms ease;
        }

        .overlay-transition {
            transition: opacity 220ms ease, visibility 220ms ease;
        }
    </style>
</head>

<body class="min-h-screen bg-app-bg text-slate-800 antialiased">

    {{-- MOBILE OVERLAY  --}}
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-slate-950/35 opacity-0 invisible overlay-transition lg:hidden"
        aria-hidden="true">
    </div>


    {{-- SIDEBAR  --}}
    @include('components.procurment.slidebar')


    {{-- MAIN APP  --}}
    <div id="appShell" class="min-h-screen transition-[padding] duration-300 lg:pl-[264px]">

        <!-- TOP BAR -->
        @include('components.procurment.topbar')


        {{-- CONTENT Intentionally empty  --}}
        <main class="min-h-[calc(100vh-76px)] p-4 sm:p-6 lg:p-7">
            @yield('content')
        </main>
    </div>


    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const mobileOpen = document.getElementById('mobileSidebarOpen');
        const mobileClose = document.getElementById('mobileSidebarClose');
        const desktopToggle = document.getElementById('desktopSidebarToggle');
        const appShell = document.getElementById('appShell');
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');

        let desktopCollapsed = false;

        // -------------------------
        // Mobile sidebar
        // -------------------------
        function openMobileSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay?.classList.remove('opacity-0', 'invisible');
            overlay?.classList.add('opacity-100', 'visible');
            document.body.classList.add('overflow-hidden');
        }

        function closeMobileSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay?.classList.add('opacity-0', 'invisible');
            overlay?.classList.remove('opacity-100', 'visible');
            document.body.classList.remove('overflow-hidden');
        }

        mobileOpen?.addEventListener('click', openMobileSidebar);
        mobileClose?.addEventListener('click', closeMobileSidebar);
        overlay?.addEventListener('click', closeMobileSidebar);

        // Close mobile drawer after clicking a navigation link
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeMobileSidebar();
                }
            });
        });

        // -------------------------
        // Desktop collapse
        // -------------------------
        function setDesktopSidebar(collapsed) {
            desktopCollapsed = collapsed;

            if (collapsed) {
                sidebar.classList.remove('lg:w-[264px]');
                sidebar.classList.add('lg:w-[76px]');

                appShell?.classList.remove('lg:pl-[264px]');
                appShell?.classList.add('lg:pl-[76px]');

                document.querySelectorAll('.sidebar-label').forEach(el => {
                    el.classList.add('lg:hidden');
                });

                document.querySelectorAll('#sidebar .nav-item, #sidebar .menu-toggle').forEach(el => {
                    el.classList.add('lg:justify-center');
                });
            } else {
                sidebar.classList.remove('lg:w-[76px]');
                sidebar.classList.add('lg:w-[264px]');

                appShell?.classList.remove('lg:pl-[76px]');
                appShell?.classList.add('lg:pl-[264px]');

                document.querySelectorAll('.sidebar-label').forEach(el => {
                    el.classList.remove('lg:hidden');
                });

                document.querySelectorAll('#sidebar .nav-item, #sidebar .menu-toggle').forEach(el => {
                    el.classList.remove('lg:justify-center');
                });
            }
        }

        desktopToggle?.addEventListener('click', () => {
            setDesktopSidebar(!desktopCollapsed);
        });

        // -------------------------
        // Sidebar submenus
        // -------------------------
        document.querySelectorAll('[data-menu-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                // Expand sidebar if collapsed on desktop
                if (window.innerWidth >= 1024 && desktopCollapsed) {
                    setDesktopSidebar(false);
                    return;
                }

                const targetId = button.dataset.menuToggle;
                const target = document.getElementById(targetId);
                const chevron = button.querySelector('.menu-chevron');

                if (!target) return;

                const isHidden = target.classList.contains('hidden');

                target.classList.toggle('hidden');
                chevron?.classList.toggle('rotate-180', isHidden);
            });
        });

        // -------------------------
        // Profile dropdown (dengan pengecekan null)
        // -------------------------
        if (profileButton && profileMenu) {
            profileButton.addEventListener('click', (event) => {
                event.stopPropagation();
                const isHidden = profileMenu.classList.contains('hidden');
                profileMenu.classList.toggle('hidden', !isHidden);
                profileButton.setAttribute('aria-expanded', String(isHidden));
            });

            document.addEventListener('click', (event) => {
                if (!profileMenu.contains(event.target) && !profileButton.contains(event.target)) {
                    profileMenu.classList.add('hidden');
                    profileButton.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // -------------------------
        // Keyboard & Resize
        // -------------------------
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeMobileSidebar();
                if (profileMenu && profileButton) {
                    profileMenu.classList.add('hidden');
                    profileButton.setAttribute('aria-expanded', 'false');
                }
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                overlay?.classList.add('opacity-0', 'invisible');
                overlay?.classList.remove('opacity-100', 'visible');
                document.body.classList.remove('overflow-hidden');
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>

</html>
