<header class="sticky top-0 z-100 flex items-center gap-3 border-b border-slate-100 px-4 py-4 sm:px-6 lg:px-9 bg-white">
    <button id="menuToggle"
        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 lg:hidden"
        aria-label="Buka navigasi" aria-expanded="false">
        <i data-lucide="menu" class="h-5 w-5"></i>
    </button>

    <div class="min-w-0 flex-1">
        <p class="text-xs font-medium text-slate-400">Medical Portal</p>
        <h1 id="pageTitle" class="mt-0.5 truncate text-lg font-semibold tracking-tight text-slate-800 sm:text-xl">
            Doctor</h1>
    </div>

    <form id="searchForm" class="hidden w-full max-w-xs sm:block" role="search">
        <label for="doctorSearch" class="sr-only">Find your doctor</label>
        <div
            class="flex items-center gap-2 rounded-xl bg-slate-50 px-3.5 py-2.5 ring-1 ring-slate-100 transition focus-within:ring-tealbrand-500">
            <i data-lucide="search" class="h-4 w-4 shrink-0 text-tealbrand-600"></i>
            <input id="doctorSearch" type="search" placeholder="Find your doctor"
                class="w-full min-w-0 bg-transparent text-sm outline-none placeholder:text-slate-400" />
            <kbd class="hidden rounded border border-slate-200 px-1.5 py-0.5 text-[10px] text-slate-400 md:inline">⌘
                K</kbd>
        </div>
    </form>

    <button
        class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-100 text-slate-500 transition hover:bg-slate-50"
        aria-label="Notifikasi">
        <i data-lucide="bell" class="h-[18px] w-[18px]"></i>
        <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-rose-400 ring-2 ring-white"></span>
    </button>

    <button class="flex shrink-0 items-center gap-2 rounded-xl p-1.5 text-left transition hover:bg-slate-50"
        aria-label="Profil pengguna">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=96&q=80"
            alt="Avatar pengguna" class="h-9 w-9 rounded-xl object-cover" />
        <span class="hidden pr-1 sm:block">
            <span class="block text-xs font-semibold text-slate-700">Alex Morgan</span>
            <span class="mt-0.5 block text-[10px] text-slate-400">Patient</span>
        </span>
        <i data-lucide="chevron-down" class="hidden h-4 w-4 text-slate-400 sm:block"></i>
    </button>
</header>
