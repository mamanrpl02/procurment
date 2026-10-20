<header class="sticky top-0 z-30 border-b border-app-border bg-white/95 backdrop-blur">
    <div class="flex h-[76px] items-center gap-3 px-4 sm:px-6 lg:px-7">

        <!-- Mobile menu -->
        <button id="mobileSidebarOpen" type="button"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-app-border text-slate-600 transition hover:bg-slate-50 lg:hidden"
            aria-label="Open navigation">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
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
                <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
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
