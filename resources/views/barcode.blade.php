<!DOCTYPE html>
<html lang="en">

<head>
    <title>Barcode</title>
    @include('layout.head')
</head>

<body class="bg-gray-50">
    <!-- sidenav -->
    @include('layout.sidebar')
    <!-- end sidenav -->

    <main class="">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- end Navbar -->

        <div class="p-5">
            <div class='w-full rounded-xl bg-white h-fit mx-auto space-y-4'>
                <div class="p-3">
                    <h1 class="font-extrabold text-3xl text-center">Tunjukkan Usulanmu Disini</h1>
                </div>
                <div class="flex justify-center items-center p-4 md:p-20">
                    <div class="">
                        {!! $qrCode !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- FOOTER --}}
        @include('layout.footer')
    </main>
    @include('sweetalert::alert')
</body>

</html>
