<div class="flex">
    <aside id="sidebar"
        class="font-poppins fixed inset-y-0 my-6 ml-4 w-full max-w-72 md:max-w-60 xl:max-w-64 2xl:max-w-64 z-50 rounded-3xl bg-white shadow-2xl overflow-y-scroll transform transition-transform duration-300 -translate-x-full md:translate-x-0 ease-in-out">
        <div class="p-2">
            <div class="">
                <a class="text-center" href="{{ route('dashboard') }}">
                    <img class="w-36 h-32 mx-auto" src="{{ asset('/logo.png') }}" alt="">
                </a>
            </div>
            <hr class="mx-5 shadow-2xl bg-transparent rounded-r-xl rounded-l-xl" />
            <div>
                <ul class="">
                    <li class="p-4 mx-2">
                        <a class="" href="{{ route('dashboard') }}">
                            <div class="flex space-x-4">
                                <div class="bg-blue-600 p-2 rounded-xl">
                                    <i class="material-icons text-white">home</i>
                                </div>
                                <div class="my-auto">
                                    <h1 class="text-gray-500 hover:text-black text-base font-normal">Dashboard</h1>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="p-4 mx-2">
                        <a class="" href="{{ route('message') }}">
                            <div class="flex space-x-4">
                                <div class="bg-blue-600 p-2 rounded-xl">
                                    <i class="material-icons text-white">chat</i>
                                </div>
                                <div class="my-auto">
                                    <h1 class="text-gray-500 hover:text-black text-base font-normal">Message</h1>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="p-4 mx-2">
                        <div class="flex space-x-4">
                            <div class="bg-blue-600 p-2 rounded-xl">
                                <i class="material-icons text-white">settings</i>
                            </div>
                            <div class="my-auto">
                                <h1 class="text-black text-base font-normal">Manage</h1>
                            </div>
                        </div>
                    </li>
                    <hr class="mx-5 shadow-2xl bg-transparent rounded-r-xl rounded-l-xl" />
                    <li class="p-4 mx-2">
                        <div class="ml-16 md:ml-14">
                            <a href="{{ route('country') }}">
                                <h1 class="text-gray-500 hover:text-black text-base font-normal">Country</h1>
                            </a>
                        </div>
                    </li>
                    <li class="p-4 mx-2">
                        <div class="ml-16 md:ml-14">
                            <a href="{{ route('category') }}">
                                <h1 class="text-gray-500 hover:text-black text-base font-normal">Category</h1>
                            </a>
                        </div>
                    </li>
                    <li class="p-4 mx-2">
                        <div class="ml-16 md:ml-14">
                            <a href="{{ route('sender') }}">
                                <h1 class="text-gray-500 hover:text-black text-base font-normal">Sender</h1>
                            </a>
                        </div>
                    </li>
                    <li class="p-4 mx-2">
                        <div class="ml-16 md:ml-14">
                            <a href="{{ route('user') }}">
                                <h1 class="text-gray-500 hover:text-black text-base font-normal">User</h1>
                            </a>
                        </div>
                    </li>
                    <hr class="mx-5 shadow-2xl bg-transparent rounded-r-xl rounded-l-xl" />
                    <li class="p-4 mx-2">
                        <a class="" href="https://ngopeninglakoni.id" target="blank">
                            <div class="flex space-x-4">
                                <div class="bg-blue-600 p-2 rounded-xl">
                                    <i class="material-icons text-white">language</i>
                                </div>
                                <div class="my-auto">
                                    <h1 class="text-gray-500 hover:text-black text-base font-normal">Website</h1>
                                </div>
                            </div>
                        </a>
                    </li>
                    <hr class="mx-5 shadow-2xl bg-transparent rounded-r-xl rounded-l-xl" />
                    <li class="p-2">
                        <form class="flex space-x-4" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <div class="bg-blue-600 p-2 rounded-xl">
                                <i class="material-icons text-white">logout</i>
                            </div>
                            <button class="text-gray-500 hover:text-black text-base font-normal" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</div>
