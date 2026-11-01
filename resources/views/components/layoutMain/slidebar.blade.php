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
            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
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
    class="nav-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.8">
        <rect x="3" y="3" width="7" height="7" rx="1" />
        <rect x="14" y="3" width="7" height="7" rx="1" />
        <rect x="3" y="14" width="7" height="7" rx="1" />
        <rect x="14" y="14" width="7" height="7" rx="1" />
    </svg>
    <span class="sidebar-label">Dashboard</span>
</a>

<!-- Purchase -->
<a href="{{ route('purchase-orders.index') }}"
    class="nav-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.8">
        <path d="M3 7h18l-2 13H5L3 7Z" />
        <path d="M8 7a4 4 0 0 1 8 0M9 11v4m6-4v4" />
    </svg>
    <span class="sidebar-label">Purchase</span>
</a>

<!-- Grouping Workflow -->
<a href="{{ route('workflow-groups.index') }}"
    class="nav-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.8">
        <rect x="3" y="3" width="7" height="5" rx="1" />
        <rect x="14" y="16" width="7" height="5" rx="1" />
        <rect x="3" y="16" width="7" height="5" rx="1" />
        <path d="M6.5 8v4h11v4M17.5 12h-11v4" />
    </svg>
    <span class="sidebar-label">Grouping Workflow</span>
</a>



<!-- Workflow Management -->
<a href="{{ route('workflows.index') }}"
    class="nav-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="1.8">
        <rect x="3" y="3" width="7" height="5" rx="1" />
        <rect x="14" y="16" width="7" height="5" rx="1" />
        <rect x="3" y="16" width="7" height="5" rx="1" />
        <path d="M6.5 8v4h11v4M17.5 12h-11v4" />
    </svg>
    <span class="sidebar-label">Workflow Management</span>
</a>



<!-- Setting Tabel -->
<a href="{{ route('r-tables.index') }}"
    class="nav-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.8">
        <ellipse cx="12" cy="5" rx="8.5" ry="3" />
        <path d="M3.5 5v14c0 1.66 3.81 3 8.5 3s8.5-1.34 8.5-3V5" />
        <path d="M3.5 12c0 1.66 3.81 3 8.5 3s8.5-1.34 8.5-3" />
    </svg>
    <span class="sidebar-label">Setting Tabel</span>
</a>

<!-- Setting Field -->
<a href="{{ route('r-fields.index') }}"
    class="nav-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <svg class="h-[17px] w-[17px] shrink-0" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.8">
        <rect x="3" y="3" width="18" height="18" rx="2" />
        <path d="M3 9h18M9 9v12M15 9v12" />
    </svg>
    <span class="sidebar-label">Setting Field</span>
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
                <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
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
                <svg class="menu-chevron h-4 w-4 transition-transform sidebar-label" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
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
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
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
