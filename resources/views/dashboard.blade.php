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

    <!-- =========================
         MOBILE OVERLAY
    ========================== -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-slate-950/35 opacity-0 invisible overlay-transition lg:hidden"
        aria-hidden="true">
    </div>


    <!-- =========================
         SIDEBAR
    ========================== -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 flex w-[264px] -translate-x-full flex-col border-r border-app-border bg-white sidebar-transition lg:translate-x-0"
        aria-label="Main navigation">

        <!-- Brand -->
        <div class="flex h-[76px] shrink-0 items-center justify-between px-5">
            <a href="#" class="flex items-center gap-2.5">
                <span class="text-[17px] font-bold tracking-tight text-slate-900">
                    Arusa Procurement
                </span>
            </a>

            <!-- Desktop collapse button -->
            <button id="desktopSidebarToggle" type="button"
                class="hidden h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 lg:flex"
                aria-label="Collapse sidebar" title="Collapse sidebar">
                <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="16" rx="2" />
                    <path d="M8 4v16" />
                </svg>
            </button>

            <!-- Mobile close -->
            <button id="mobileSidebarClose" type="button"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 lg:hidden"
                aria-label="Close navigation">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m6 6 12 12M18 6 6 18" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="custom-scrollbar min-h-0 flex-1 overflow-y-auto px-3 pb-4">

            <p class="mb-2 px-3 pt-2 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400 sidebar-label">
                Main Menu
            </p>

            <!-- Dashboard -->
            <a href="#"
                class="nav-item group flex items-center gap-3 rounded-lg bg-slate-100 px-3 py-2.5 text-[13px] font-semibold text-slate-900">
                <svg class="h-[17px] w-[17px] shrink-0 text-slate-700" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z" />
                </svg>
                <span class="sidebar-label">Dashboard</span>
            </a>

            <!-- 1. Purchase Order (PO) -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="po-menu"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                        <polyline points="10 9 9 9 8 9" />
                    </svg>
                    <span class="sidebar-label flex-1">Purchase Order (PO)</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="po-menu" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Buat
                        PO Baru</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Daftar
                        PO (PO List)</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Persetujuan
                        PO</a>
                </div>
            </div>

            <!-- 2. Portal Supplier -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="supplier-portal"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <span class="sidebar-label flex-1">Portal Supplier</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="supplier-portal" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Order
                        Masuk</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Supplier
                        Input Routine</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Forecast
                        RPT</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Cetak
                        Kanban / Label</a>
                </div>
            </div>

            <!-- 3. Logistik & Penerimaan -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="logistics"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <rect x="1" y="3" width="15" height="13" />
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                        <circle cx="5.5" cy="18.5" r="2.5" />
                        <circle cx="18.5" cy="18.5" r="2.5" />
                    </svg>
                    <span class="sidebar-label flex-1">Logistik &amp; Penerimaan</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="logistics" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Jadwal
                        Pengiriman</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Penerimaan
                        Barang (Inbound)</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Riwayat
                        Pengiriman</a>
                </div>
            </div>

            <!-- 4. Stok & Gudang -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="warehouse"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path d="m4 7 8-4 8 4-8 4-8-4Z" />
                        <path d="M4 7v10l8 4 8-4V7M12 11v10" />
                    </svg>
                    <span class="sidebar-label flex-1">Stok &amp; Gudang</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="warehouse" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Monitoring
                        Stok</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Stock
                        Opname</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Pengeluaran
                        Barang</a>
                </div>
            </div>

            <!-- 5. Keuangan & Tagihan -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="finance"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <line x1="12" y1="8" x2="12" y2="16" />
                        <path d="M16 10h-5.5a1.5 1.5 0 0 0 0 3h3a1.5 1.5 0 0 1 0 3H8" />
                    </svg>
                    <span class="sidebar-label flex-1">Keuangan &amp; Tagihan</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="finance" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Bill
                        Approval</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Status
                        Pembayaran</a>
                </div>
            </div>

            <!-- 6. Laporan & Analisis -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="analytics"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <rect x="4" y="3" width="16" height="18" rx="2" />
                        <path d="M8 17v-4M12 17V8M16 17v-7" />
                    </svg>
                    <span class="sidebar-label flex-1">Laporan &amp; Analisis</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="analytics" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Laporan
                        Pembelian</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Laporan
                        Performa Supplier</a>
                </div>
            </div>

            <!-- 7. Master Data -->
            <div class="mt-1">
                <button type="button" data-menu-toggle="master-data"
                    class="menu-toggle flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    </svg>
                    <span class="sidebar-label flex-1">Master Data</span>
                    <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                </button>
                <div id="master-data" class="submenu hidden pl-10 pr-2 pt-1">
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Data
                        Barang / Item</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Data
                        Supplier</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Data
                        Gudang &amp; Rak</a>
                    <a href="#"
                        class="block rounded-md px-2 py-2 text-xs text-slate-500 hover:bg-slate-50 hover:text-slate-800">Data
                        User &amp; Akses</a>
                </div>
            </div>

            <!-- Divider -->
            <div class="my-5 border-t border-app-border"></div>

            <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400 sidebar-label">
                Operations &amp; Settings
            </p>

            <!-- Inventory Alerts -->
            <a href="#"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <path
                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                <span class="sidebar-label flex-1">Peringatan Stok</span>
                <span
                    class="sidebar-label rounded-full bg-red-100 px-1.5 py-0.5 text-[9px] font-bold text-red-600">06</span>
            </a>

            <!-- User Roles & Permissions -->
            <a href="#"
                class="mt-1 flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <path d="M12 3 20 6v6c0 4.5-3.1 7.6-8 9-4.9-1.4-8-4.5-8-9V6l8-3Z" />
                    <path d="M9 12h6M12 9v6" />
                </svg>
                <span class="sidebar-label">Akses &amp; Peran User</span>
            </a>

            <!-- Help Center -->
            <a href="#"
                class="mt-1 flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M9.5 9a2.5 2.5 0 0 1 5 0c0 2-2.5 2-2.5 4" />
                    <path d="M12 17h.01" />
                </svg>
                <span class="sidebar-label">Pusat Bantuan</span>
            </a>

        </nav>

        <!-- Bottom actions -->
        <div class="shrink-0 border-t border-app-border bg-white p-3">
            <!-- Logout -->
            <a href="#"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <path d="M10 17l5-5-5-5" />
                    <path d="M15 12H3" />
                    <path d="M20 4v16" />
                </svg>
                <span class="sidebar-label">Keluar / Logout</span>
            </a>

            <!-- User Profile -->
            <div class="mt-3 flex items-center gap-3 rounded-xl bg-slate-50 p-2.5">
                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-slate-300 text-xs font-bold text-slate-700">
                    LC
                </div>
                <div class="sidebar-label min-w-0 flex-1">
                    <p class="truncate text-[12px] font-semibold text-slate-800">Lena Carter</p>
                    <p class="truncate text-[10px] text-slate-400">Administrator</p>
                </div>
            </div>
        </div>
    </aside>


    <!-- =========================
         MAIN APP
    ========================== -->
    <div id="appShell" class="min-h-screen transition-[padding] duration-300 lg:pl-[264px]">

        <!-- TOP BAR -->
        <header class="sticky top-0 z-30 border-b border-app-border bg-white/95 backdrop-blur">
            <div class="flex h-[76px] items-center gap-3 px-4 sm:px-6 lg:px-7">

                <!-- Mobile menu -->
                <button id="mobileSidebarOpen" type="button"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-app-border text-slate-600 transition hover:bg-slate-50 lg:hidden"
                    aria-label="Open navigation">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Desktop collapsed sidebar toggle -->
                <button id="mobileLikeToggle" type="button"
                    class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-app-border text-slate-600 transition hover:bg-slate-50 lg:hidden"
                    aria-label="Toggle navigation">
                </button>

                <!-- Search -->
                <div class="relative max-w-[420px] flex-1 sm:mx-auto">
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-[17px] w-[17px] -translate-y-1/2 text-slate-400"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-4-4" />
                    </svg>
                    <input type="search" placeholder="Search products, customers, or orders..."
                        class="h-10 w-full rounded-xl border border-app-border bg-slate-50/70 pl-10 pr-4 text-[12px] text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:bg-white focus:ring-3 focus:ring-emerald-50">
                </div>

                <!-- Actions -->
                <div class="ml-auto flex shrink-0 items-center gap-1.5 sm:gap-2">

                    <button type="button"
                        class="hidden h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-50 hover:text-slate-800 sm:flex"
                        aria-label="Messages">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path
                                d="M20 11.5a7.5 7.5 0 0 1-8 7.5 8.5 8.5 0 0 1-3.2-.6L4 20l1.6-3.7A7.4 7.4 0 0 1 4 11.5 7.5 7.5 0 0 1 12 4a7.5 7.5 0 0 1 8 7.5Z" />
                            <path d="M8 11.5h.01M12 11.5h.01M16 11.5h.01" />
                        </svg>
                    </button>

                    <button type="button"
                        class="relative flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-50 hover:text-slate-800"
                        aria-label="Notifications">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" />
                            <path d="M10 21h4" />
                        </svg>
                        <span
                            class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                    </button>

                    <!-- Profile -->
                    <button id="profileButton" type="button"
                        class="ml-0.5 flex items-center gap-2 rounded-xl p-1.5 transition hover:bg-slate-50"
                        aria-expanded="false">
                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-300 text-[10px] font-bold text-slate-700">
                            LC
                        </span>
                        <svg class="hidden h-4 w-4 text-slate-400 sm:block" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <path d="m7 10 5 5 5-5" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div id="profileMenu"
                        class="absolute right-4 top-[66px] hidden w-48 rounded-xl border border-app-border bg-white p-1.5 shadow-xl shadow-slate-900/10 sm:right-6 lg:right-7">
                        <a href="#"
                            class="block rounded-lg px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50">My
                            Profile</a>
                        <a href="#"
                            class="block rounded-lg px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50">Settings</a>
                        <div class="my-1 border-t border-app-border"></div>
                        <a href="#"
                            class="block rounded-lg px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-50">Logout</a>
                    </div>
                </div>
            </div>
        </header>


        <!-- =========================
             CONTENT
             Intentionally empty
        ========================== -->
        <main class="min-h-[calc(100vh-76px)] p-4 sm:p-6 lg:p-7">
            <!-- Content goes here -->
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
