<div x-data="themeSwitcher()" x-init="initializeTheme" class="relative mr-3">
    <div @click="showDropdown = !showDropdown" class="dark:text-white">
        <x-phosphor-sun x-show="selectedTheme === 'light'" class="w-6 h-6 cursor-pointer" style="display: none;" />
        <x-phosphor-moon x-show="selectedTheme === 'dark'" class="w-6 h-6 cursor-pointer" style="display: none;" />
        <x-phosphor-desktop x-show="selectedTheme === 'system'" class="w-6 h-6 cursor-pointer" style="display: none;" />
    </div>

    <div x-show="showDropdown" @click.away="showDropdown = false"
        class="absolute z-50 top-full right-0 bg-white rounded-lg ring-1 ring-slate-900/10 shadow-lg overflow-hidden w-36 py-1 text-sm text-slate-700 font-semibold dark:bg-slate-800 dark:ring-0 dark:highlight-white/5 dark:text-slate-300 mt-8"
        style="--button-width: 24px; display:none;">
        <div class="py-1 px-2 flex items-center cursor-pointer dark:hover:bg-slate-600/30" role="option" tabindex="-1"
            aria-selected="false" @click="changeTheme('light')">
            <x-phosphor-sun class="w-5 h-6 mr-2 cursor-pointer" />Light
        </div>
        <div class="py-1 px-2 flex items-center cursor-pointer dark:hover:bg-slate-600/30" role="option" tabindex="-1"
            aria-selected="false" @click="changeTheme('dark')">
            <x-phosphor-moon class="w-5 h-6 mr-2 cursor-pointer" />Dark
        </div>
        <div class="py-1 px-2 flex items-center cursor-pointer dark:hover:bg-slate-600/30" role="option" tabindex="-1"
            aria-selected="false" @click="changeTheme('system')">
            <x-phosphor-desktop class="w-5 h-6 mr-2 cursor-pointer" />System
        </div>
    </div>
</div>


<script>
    function themeSwitcher() {
        return {
            selectedTheme: 'system',
            showDropdown: false,

            initializeTheme() {
                // Check session storage for saved theme
                const savedTheme = sessionStorage.getItem('theme') || 'system';
                this.selectedTheme = savedTheme;
                this.applyTheme(savedTheme);
            },

            changeTheme(theme) {
                this.selectedTheme = theme;
                sessionStorage.setItem('theme', theme);
                this.applyTheme(theme);
            },

            applyTheme(theme) {
                const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
                const isDarkMode = theme === "dark" || (theme === "system" && prefersDark);

                document.documentElement.classList.toggle("dark", isDarkMode);
                document.documentElement.classList.toggle("light", !isDarkMode);
                document.documentElement.style.colorScheme = isDarkMode ? 'dark' : 'light';
            }
        }
    }
</script>
