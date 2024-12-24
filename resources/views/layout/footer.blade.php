<style>
    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .animate-marquee {
        display: flex;
        animation: marquee 20s linear infinite;
    }

    .flex h1 {
        white-space: nowrap;
    }
</style>
<div class="fixed bottom-0 p-2 bg-orange-500 right-0 left-0 overflow-hidden">
    <div class="flex animate-marquee">
        <h1 class="font-bold text-white text-xl">
            Selamat & Sukses Ahmad Luthfi & Taj Yasin Gubernur & Wakil Gubernur Jateng 2024-2029.
        </h1>
        <h1 class="font-bold text-white text-xl">
            Bersama Ngopeni, Nglakoni Jateng untuk kemajuan dan kesejahteraan.
        </h1>
        <h1 class="font-bold text-white text-xl">
            Saatnya melangkah maju, membawa harapan baru untuk Jawa Tengah!
        </h1>
    </div>
</div>
