<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    @include('layout.head')
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
            <div class='w-full rounded-xl h-fit mx-auto space-y-2'>
                <div class="grid grid-cols-2 gap-4 p-2">
                    <!-- card1 -->
                    <div class="bg-red-500 p-6 rounded-lg shadow-xl">
                        <h1 class="text-2xl text-white font-bold">{{ $message }}</h1>
                        <h1 class="text-xl font-light text-white text-right">Message</h1>
                    </div>
                    <!-- card4 -->
                    <div class="bg-yellow-500 p-6 rounded-lg shadow-xl">
                        <h1 class="text-2xl text-white font-bold">{{ $sender }}</h1>
                        <h1 class="text-xl font-light text-white text-right">Sender</h1>
                    </div>
                </div>
                <!-- chart section -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 ">
                    <!-- chart 1 -->
                    <div class="p-6 bg-white rounded-xl shadow-xl my-auto">
                        <h1 class="font-light">Pesan Berdasarkan Daerah</h1>
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <div class="md:w-5/6 mx-auto">
                            <canvas id="daerahChart" width="50" height="50"></canvas>
                        </div>
                    </div>
                    <!-- chart 2 -->
                    <div class="p-6 bg-white rounded-xl shadow-xl my-auto">
                        <h1 class="font-light">Pesan Berdasarkan Kategori</h1>
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <div class="md:w-5/6 mx-auto">
                            <canvas id="categoryChart" width="50" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://js.pusher.com/8.3.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher("ivpc4objrm2qhg4k3uhy", {
            cluster: "",
            enabledTransports: ['ws'],
            forceTLS: false,
            wsHost: "192.168.100.28",
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
            document.querySelector('.bg-red-500 .font-bold').textContent = data.message_count;

            // Update Total Senders
            document.querySelector('.bg-yellow-500 .font-bold').textContent = data.sender_count;
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
    @include('sweetalert::alert')
</body>

</html>
