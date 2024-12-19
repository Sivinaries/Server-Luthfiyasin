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
    <main class="md:ml-64 xl:ml-72 2xl:ml-72">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- end Navbar -->
        <div class="p-5">
            <div class='w-full rounded-xl h-fit mx-auto space-y-2'>
                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-4 lg:grid-cols-4 gap-4 p-2">
                    <!-- card1 -->
                    <a href="">
                        <div class="bg-red-500 p-6 rounded-lg shadow-xl">
                            <h1 class="text-2xl text-white font-bold">{{ $message }}</h1>
                            <h1 class="text-xl font-light text-white text-right">Message</h1>
                        </div>
                    </a>
                    <!-- card2 -->
                    <a href="">
                        <div class="bg-blue-500 p-6 rounded-lg shadow-xl">
                            <h1 class="text-2xl text-white font-bold">{{ $country }}</h1>
                            <h1 class="text-xl font-light text-white text-right">Country</h1>
                        </div>
                    </a>
                    <!-- card3 -->
                    <a href="">
                        <div class="bg-green-500 p-6 rounded-lg shadow-xl">
                            <h1 class="text-2xl text-white font-bold">{{ $category }}</h1>
                            <h1 class="text-xl font-light text-white text-right">Category</h1>
                        </div>
                    </a>
                    <!-- card4 -->
                    <a href="#">
                        <div class="bg-yellow-500 p-6 rounded-lg shadow-xl">
                            <h1 class="text-2xl text-white font-bold">{{ $sender }}</h1>
                            <h1 class="text-xl font-light text-white text-right">Sender</h1>
                        </div>
                    </a>
                </div>
                <!-- chart section -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 ">
                    <!-- chart 1 -->
                    <div class="p-6 bg-white rounded-xl shadow-xl ">
                        <h1 class="font-light">Pesan Berdasarkan Daerah</h1>
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <canvas id="daerahChart" width="50" height="50"></canvas>
                    </div>
                    <!-- chart 2 -->
                    <div class="p-6 bg-white rounded-xl shadow-xl">
                        <h1 class="font-light">Pesan Berdasarkan Kategori</h1>
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <canvas id="categoryChart" width="20" height="20"></canvas>
                    </div>
                </div>
                <!-- chart 3 -->
                <div class="grid grid-cols-1">
                    <div class="p-6 bg-white rounded-xl shadow-xl">
                        <h1 class="font-light">Total Pesan Masuk</h1>
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <canvas id="grafikHistoy" width="100" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //DAERAH CHART

        var ctx = document.getElementById('daerahChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($labels1), // Region names (Daerah)
                datasets: [{
                    label: 'Messages Count',
                    data: @json($data1), // Message counts per region
                    backgroundColor: @json($colors1), // Colors from the backend
                    borderColor: @json($colors1).map(color1 => color1.replace('0.2',
                        '1')), // Darker borders
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw +
                                    ' messages'; // Show count in tooltip
                            }
                        }
                    }
                }
            }
        });

        //CATEGORY CHART

        var ctx = document.getElementById('categoryChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($labels2), // Region names (Daerah)
                datasets: [{
                    label: 'Messages Count',
                    data: @json($data2), // Message counts per region
                    backgroundColor: @json($colors2), // Colors from the backend
                    borderColor: @json($colors2).map(color2 => color2.replace('0.2',
                        '1')), // Darker borders
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw +
                                    ' messages'; // Show count in tooltip
                            }
                        }
                    }
                }
            }
        });
    </script>

    @include('layout.script')
    @include('sweetalert::alert')
</body>

</html>
