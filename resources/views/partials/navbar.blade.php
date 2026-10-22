<!-- Reusable Partial: Navbar with active link detection using request()->routeIs() -->
<nav class="bg-indigo-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Brand -->
            <div class="flex items-center gap-3">
                <span class="text-2xl">🎓</span>
                <div>
                    <a href="{{ route('home') }}" class="font-bold text-lg text-white hover:text-indigo-200 transition">
                        GPC EduPortal
                    </a>
                    <span class="hidden sm:inline-block text-xs text-indigo-300 ml-2 px-2 py-0.5 rounded bg-indigo-800/60 font-mono">
                        Practical 8 · Blade System
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-1 sm:space-x-2 text-sm font-medium">
                <a href="{{ route('home') }}" 
                   class="px-3 py-2 rounded-md transition {{ request()->routeIs('home') ? 'bg-indigo-800 text-white shadow-sm font-semibold' : 'text-indigo-100 hover:bg-indigo-800/60' }}">
                    Home
                </a>
                <a href="{{ route('about') }}" 
                   class="px-3 py-2 rounded-md transition {{ request()->routeIs('about') ? 'bg-indigo-800 text-white shadow-sm font-semibold' : 'text-indigo-100 hover:bg-indigo-800/60' }}">
                    About
                </a>
                <a href="{{ route('contact') }}" 
                   class="px-3 py-2 rounded-md transition {{ request()->routeIs('contact') ? 'bg-indigo-800 text-white shadow-sm font-semibold' : 'text-indigo-100 hover:bg-indigo-800/60' }}">
                    Contact
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="px-3 py-2 rounded-md text-amber-300 hover:bg-indigo-800/60 transition">
                    CRUD Mini Project
                </a>
            </div>
        </div>
    </div>
</nav>
