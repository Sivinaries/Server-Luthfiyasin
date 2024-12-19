<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search Result</title>
    @include('layout.head')
    <link href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" />
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
            <div class='w-full bg-white rounded-xl h-fit mx-auto'>
                <div class="p-3 text-center">
                    <h1 class="font-extrabold text-3xl">Search Result</h1>
                </div>
                <div class="p-6">
                    <div class="space-y-8">
                        <div class='space-y-2'>
                            <div class="">
                                <h1 class="font-extrabold text-3xl">Message</h1>
                            </div>
                            <div class="p-2">
                                <div class="overflow-auto">
                                    <table id="Message" class="bg-gray-50 border-2">
                                        <thead class="w-full">
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Kategori</th>
                                            <th>Nama</th>
                                            <th>Pekerjaan</th>
                                            <th>Whatsapp</th>
                                            <th>Email</th>
                                            <th>Usia</th>
                                            <th>Daerah</th>
                                            <th>Pengarepan</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($messages as $item)
                                                <tr class="border-2">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->category->nama }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->pekerjaan }}</td>
                                                    <td>{{ $item->whatsapp }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->usia }}</td>
                                                    <td>{{ $item->daerah->nama }}</td>
                                                    <td>{{ $item->pengarepan }}</td>
                                                    <td class="">
                                                        <div class="w-full">
                                                            <form
                                                                class="p-2 text-white hover:text-black bg-red-500 rounded-xl text-center"
                                                                method="post"
                                                                action="{{ route('delcategory', ['id' => $item->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#Message', {
                columnDefs: [{
                    targets: 1, // Index of the 'Date' column
                    render: function(data, type, row) {
                        // Assuming the date is in 'YYYY-MM-DD HH:MM:SS' format
                        var date = new Date(data);
                        return date.toLocaleDateString(); // Format the date as needed
                    },
                }, ],
            });
        });
        $(document).ready(function() {
            let table = new DataTable('#Tableemployee', {
                columnDefs: [{
                    targets: 1, // Index of the 'Date' column
                    render: function(data, type, row) {
                        // Assuming the date is in 'YYYY-MM-DD HH:MM:SS' format
                        var date = new Date(data);
                        return date.toLocaleDateString(); // Format the date as needed
                    },
                }, ],
            });
        });
        $(document).ready(function() {
            let table = new DataTable('#Tablechair', {
                columnDefs: [{
                    targets: 1, // Index of the 'Date' column
                    render: function(data, type, row) {
                        // Assuming the date is in 'YYYY-MM-DD HH:MM:SS' format
                        var date = new Date(data);
                        return date.toLocaleDateString(); // Format the date as needed
                    },
                }, ],
            });
        });
        $(document).ready(function() {
            let table = new DataTable('#Tablediscount', {
                columnDefs: [{
                    targets: 1, // Index of the 'Date' column
                    render: function(data, type, row) {
                        // Assuming the date is in 'YYYY-MM-DD HH:MM:SS' format
                        var date = new Date(data);
                        return date.toLocaleDateString(); // Format the date as needed
                    },
                }, ],
            });
        });
        $(document).ready(function() {
            let table = new DataTable('#Tablehistory', {
                columnDefs: [{
                    targets: 1, // Index of the 'Date' column
                    render: function(data, type, row) {
                        // Assuming the date is in 'YYYY-MM-DD HH:MM:SS' format
                        var date = new Date(data);
                        return date.toLocaleDateString(); // Format the date as needed
                    },
                }, ],
            });
        });
    </script>
    @include('layout.script')

</body>

</html>
