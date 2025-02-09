<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Category</title>
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
            <div class='w-full bg-white rounded-xl h-fit mx-auto'>
                <div class="p-3 text-center">
                    <h1 class="font-extrabold text-3xl">Edit category</h1>
                </div>
                <div class="p-6">
                    <form class="space-y-3" method="post" action="{{ route('updatecategory', ['id' => $category->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="space-y-2">
                            <label class="font-semibold text-black">Category:</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                id="nama" name="nama" value="{{ $category->nama }}" required>
                        </div>
                        <button type="submit"
                            class="bg-blue-500 text-white p-4 w-full hover:text-black rounded-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- FOOTER --}}
        @include('layout.footer')
    </main>
</body>

</html>
