<!DOCTYPE html>
<html lang="en">

<head>
    <title>Message</title>
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
                    <div class="flex justify-between">
                        <h1 class="font-extrabold text-3xl">Message</h1>
                        <a class="p-2 bg-green-500 rounded-xl text-white hover:text-black text-center"
                            href="{{ route('export') }}">Export</a>
                    </div>
                </div>
                <div class="p-2">
                    <div class="overflow-auto">
                        <table id="myTable" class="bg-gray-50 border-2">
                            <thead class="w-full">
                                <th>No</th>
                                <th>Date</th>
                                <th>Kategori</th>
                                <th>Nama</th>
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
                                        <td>{{ $item->daerah->nama }}</td>
                                        <td>{{ $item->pengarepan }}</td>
                                        <td class="">
                                            <div class="w-full">
                                                <form
                                                    class="p-2 text-white hover:text-black bg-red-500 rounded-xl text-center"
                                                    method="post"
                                                    action="{{ route('delmessage', ['id' => $item->id]) }}">
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
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable', {
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

        channel.bind("new-message", function(data) {
            let table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
            let row = table.insertRow();

            const fields = [
                table.rows.length,
                new Date(data.created_at).toLocaleDateString(),
                data.category,
                data.nama,
                data.pekerjaan,
                data.whatsapp,
                data.email,
                data.usia,
                data.daerah,
                data.pengarepan,
                `<form method="post" action="/message/delete/${data.id}">
                    <button type="submit" class="p-2 text-white hover:text-black bg-red-500 rounded-xl text-center">Delete</button>
                </form>`
            ];

            fields.forEach((value, index) => {
                let cell = row.insertCell(index);
                cell.innerHTML = value;
            });
        });
    </script>

    @include('sweetalert::alert')
</body>

</html>
