<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 flex h-screen w-[88px] shrink-0 flex-col items-center overflow-hidden rounded-r-[2rem] bg-tealbrand-600 py-8 text-white transition-transform duration-300 ease-in-out 
              -translate-x-[120%]  duration-300 lg:static lg:translate-x-0">
    <a href="#" class="mb-10 flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 text-white"
        aria-label="Beranda">
        <i data-lucide="activity" class="h-6 w-6"></i>
    </a>

    <nav class="flex w-full flex-1 flex-col items-center gap-4" aria-label="Navigasi utama">
        <button
            class="nav-link flex h-[66px] w-[68px] flex-col items-center justify-center gap-1.5 rounded-2xl text-white/80 hover:bg-white/10"
            data-page="Dashboard" aria-label="Dashboard">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
            <span class="text-[10px] font-medium">Dashboard</span>
        </button>
        <button class="nav-link active flex h-[66px] w-[68px] flex-col items-center justify-center gap-1.5 rounded-2xl"
            data-page="Doctor" aria-label="Doctor" aria-current="page">
            <i data-lucide="stethoscope" class="h-5 w-5"></i>
            <span class="text-[10px] font-semibold">Doctor</span>
        </button>
        <button
            class="nav-link flex h-[66px] w-[68px] flex-col items-center justify-center gap-1.5 rounded-2xl text-white/80 hover:bg-white/10"
            data-page="Contact" aria-label="Contact">
            <i data-lucide="users-round" class="h-5 w-5"></i>
            <span class="text-[10px] font-medium">Contact</span>
        </button>
        <button
            class="nav-link flex h-[66px] w-[68px] flex-col items-center justify-center gap-1.5 rounded-2xl text-white/80 hover:bg-white/10"
            data-page="Tracker" aria-label="Tracker">
            <i data-lucide="chart-no-axes-combined" class="h-5 w-5"></i>
            <span class="text-[10px] font-medium">Tracker</span>
        </button>
    </nav>

    <button
        class="mt-6 flex h-10 w-10 items-center justify-center rounded-xl text-white/75 transition hover:bg-white/10 hover:text-white"
        aria-label="Pengaturan">
        <i data-lucide="settings-2" class="h-5 w-5"></i>
    </button>
</aside>
