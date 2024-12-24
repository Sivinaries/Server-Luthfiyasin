<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    @include('layout.head')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-container {
            overflow: hidden;
        }

        .swiper-slide {
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- sidenav  -->
    @include('layout.sidebar')
    <!-- end sidenav -->
    <main class="">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- end Navbar -->
        <div class="p-5">
            <div class=''>
                <div class="grid grid-cols-2 md:grid-cols-6">
                    <div class="grid p-2 col-span-full md:col-span-3">
                        <div class="p-6 bg-white rounded-xl shadow-xl border-blue-800 border-4">
                            <img class="w-full h-full" src="{{ asset('assets/home.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 p-2 col-span-full md:col-span-3">
                        <!-- chart 1 -->
                        <div class="bg-white rounded-xl shadow-xl border-blue-800 border-4 space-y-2">
                            <h1 class="md:text-lg text-black font-bold text-center">Pesan Berdasarkan Daerah</h1>
                            <i class="fa fa-arrow-up text-lime-500"></i>
                            <div class="md:w-4/5 mx-auto">
                                <canvas id="daerahChart" width="100" height="100"></canvas>
                            </div>
                        </div>
                        <!-- chart 2 -->
                        <div class="bg-white rounded-xl shadow-xl border-blue-800 border-4 space-y-2">
                            <h1 class="md:text-lg text-black font-bold text-center">Pesan Berdasarkan Kategori</h1>
                            <i class="fa fa-arrow-up text-lime-500"></i>
                            <div class="md:w-4/5 mx-auto">
                                <canvas id="categoryChart" width="100" height="100"></canvas>
                            </div>
                        </div>
                        <!-- card 1 -->
                        <div
                            class="bg-white rounded-lg shadow-xl flex flex-col justify-center items-center space-y-2 border-blue-800 border-4">
                            <h1 class="text-xl md:text-3xl font-light text-black text-center">Message</h1>
                            <h1 class="text-xl md:text-5xl text-black font-bold text-center message">
                                6{{ $message }}</h1>
                        </div>
                        <!-- card 2 -->
                        <div
                            class="bg-white rounded-lg shadow-xl flex flex-col justify-center items-center space-y-2 border-blue-800 border-4">
                            <h1 class="text-xl md:text-3xl font-light text-black text-center">Sender</h1>
                            <h1 class="text-xl md:text-5xl text-black font-bold text-center sender">6{{ $sender }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <div class="p-2 md:p-24 rounded-xl shadow-xl border-blue-800 border-4 space-y-4"
                        style="background-image: url('{{ asset('assets/bg.png') }}'); background-size: cover; background-position: center;">
                        <div class="bg-white p-2 md:p-12 rounded-xl md:w-3/4 mx-auto border-4 border-blue-800">
                            <h1 class="text-xl md:text-4xl text-black font-bold text-center">Terima Kasih Atas
                                Partisipasinya
                            </h1>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($nama as $item)
                                        <div class="swiper-slide">
                                            <h1 class="text-xl md:text-4xl text-black font-bold text-center nama">
                                                {{ $item }}</h1>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- FOOTER --}}
        @include('layout.footer')
    </main>
    <script src="https://js.pusher.com/8.3.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher("ivpc4objrm2qhg4k3uhy", {
            cluster: "",
            enabledTransports: ['ws'],
            forceTLS: false,
            wsHost: "192.168.100.23",
            wsPort: "8080"
        });


        var channel = pusher.subscribe("messages");

        channel.bind('new-message', function(data) {
            // Update Region Chart
            daerahChart.data.labels = Object.keys(data.chartData.regions); // Names (not IDs)
            daerahChart.data.datasets[0].data = Object.values(data.chartData.regions); // Counts
            daerahChart.update();

            // Update Category Chart
            categoryChart.data.labels = Object.keys(data.chartData.categories); // Names (not IDs)
            categoryChart.data.datasets[0].data = Object.values(data.chartData.categories); // Counts
            categoryChart.update();

            // Update Total Messages
            document.querySelector('.message').textContent = data.message_count;

            // Update Total Senders
            document.querySelector('.sender').textContent = data.sender_count;

            // Update Nama Senders
            document.querySelector('.nama').textContent = data.nama;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var daerahChart = new Chart(document.getElementById('daerahChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json($labels1),
                datasets: [{
                    label: 'Messages by Region',
                    data: @json($data1),
                    backgroundColor: @json($colors1),
                    borderColor: @json($colors1).map(color => color.replace('0.2', '1')),
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' messages';
                            },
                        },
                    },
                },
            },
        });

        var categoryChart = new Chart(document.getElementById('categoryChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json($labels2),
                datasets: [{
                    label: 'Messages by Category',
                    data: @json($data2),
                    backgroundColor: @json($colors2),
                    borderColor: @json($colors2).map(color => color.replace('0.2', '1')),
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' messages';
                            },
                        },
                    },
                },
            },
        });
    </script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 100,
            slidesPerView: 1,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
