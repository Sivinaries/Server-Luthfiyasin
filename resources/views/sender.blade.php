<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sender</title>
    @include('layout.head')
    <link href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" />
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
            <div class='w-full rounded-xl bg-white h-fit mx-auto'>
                <div class="p-3">
                    <div class="">
                        <h1 class="font-extrabold text-3xl">Sender</h1>
                    </div>
                </div>
                <div class="p-2">
                    <div class="overflow-auto">
                        <table id="myTable" class="bg-gray-50 border-2">
                            <thead class="w-full">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pekerjaan</th>
                                <th>Whatsapp</th>
                                <th>Email</th>
                                <th>Usia</th>
                                <th>Daerah</th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($senders as $item)
                                    <tr class="border-2">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td>{{ $item->whatsapp }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->usia }}</td>
                                        <td>{{ $item->daerah->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- FOOTER --}}
        @include('layout.footer')
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable', {

            });
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
