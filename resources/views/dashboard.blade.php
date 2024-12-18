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
            <div class='w-full rounded-xl h-fit mx-auto'>
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
            </div>

            <!-- chart section -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 ">
                <!-- chart 1: Total Order -->
                <div class="p-6 bg-white rounded-xl shadow-xl">
                    <h1 class="font-light">Total Order</h1>
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <canvas id="grafikHistoy" width="100" height="50"></canvas>
                </div>
                <!-- chart 2: Total Revenue -->
                <div class="p-6 bg-white rounded-xl shadow-xl">
                    <h1 class="font-light">Total Revenue</h1>
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <canvas id="grafikRevenue" width="100" height="50"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('layout.script')
    @include('sweetalert::alert')

</body>

</html>
