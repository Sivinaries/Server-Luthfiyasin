<nav id="navbar" class="font-poppins mx-3 xl:mx-4 rounded-xl bg-white bg-opacity-90 sticky top-0 z-40 transform transition-transform duration-300">
    <div class="flex justify-around md:justify-end p-4 space-x-2 md:space-x-4">
        <div class="flex justify-end items-end my-auto">
            <button id="toggle-button" class="transform transition-transform duration-300">
                <!-- Hamburger icon -->
                <svg id="menu-open" class="block" width="20px" height="30px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H20" stroke="#000000" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <!-- X icon -->
                <svg id="menu-close" class="hidden" width="20px" height="30px" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" fill="none">
                    <path fill="#000000" fill-rule="evenodd"
                        d="M18 5a1 1 0 100-2H2a1 1 0 000 2h16zm0 4a1 1 0 100-2h-8a1 1 0 100 2h8zm1 3a1 1 0 01-1 1H2a1 1 0 110-2h16a1 1 0 011 1zm-1 5a1 1 0 100-2h-8a1 1 0 100 2h8z" />
                </svg>
            </button>
        </div>
    </div>
</nav>

<script>
    document.getElementById('toggle-button').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const menuOpen = document.getElementById('menu-open');
        const menuClose = document.getElementById('menu-close');

        sidebar.classList.toggle('-translate-x-full');

        menuOpen.classList.toggle('hidden');
        menuClose.classList.toggle('hidden');

        // Add rotation animation
        menuOpen.classList.toggle('rotate');
    });
</script>
