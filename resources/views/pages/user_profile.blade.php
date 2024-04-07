@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">
        <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
            <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12">

                <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>
                <button onclick="showDiv1()"
                        class="flex items-center px-3 py-2.5 font-semibold  hover:text-indigo-900 hover:border hover:rounded-full">
                    Account Settings
                </button>
                <button onclick="showDiv2()"
                        class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full  ">
                    Change Password
                </button>
            </div>
        </aside>
        <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            @if(session('success'))
                <p class="text-green-500">{{ session('success') }}</p>
            @endif
            <div id="div-1" class="p-2 md:p-4">
                <form action="/user/general-update" method="post"
                      enctype="multipart/form-data"
                      class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    @csrf
                    @method('PUT')
                    <h2 class="pl-6 text-2xl font-bold sm:text-xl">Public Profile</h2>

                    <div class="grid max-w-2xl mx-auto mt-8">
                        @error('avatar')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">
                            <img id="avatarPreview" class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-red-800"
                                 src="{{ Auth::user()->avatar === null ? asset('storage/images/default_avatar.png') : asset('storage/' . Auth::user()->avatar) }}"
                                 alt="Bordered avatar">
                            <div class="flex flex-col space-y-5 sm:ml-8">
                                <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*"
                                       onchange="previewImage(event)">
                                <label for="avatarInput"
                                       class="py-3.5 px-7 text-base font-medium text-indigo-900 cursor-pointer focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-[#202142] focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                    Change Picture
                                </label>
                            </div>
                        </div>

                        <script>

                            function previewImage(event) {
                                const reader = new FileReader();
                                reader.onload = function () {
                                    const preview = document.getElementById('avatarPreview');
                                    preview.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>


                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                            @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                            <div
                                    class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="w-full">
                                    <label for="name"
                                           class="block mb-2 text-sm font-medium text-indigo-900 ">Your
                                        full name </label>
                                    <input type="text" name="name"
                                           id="name"
                                           class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                           placeholder="Your first name" value="{{ Auth::user()->name }}" required>
                                </div>

                            </div>

                            <div class="mb-2 sm:mb-6">
                                @error('email')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-indigo-900 ">Your
                                    email</label>
                                <input type="email" id="email" name="email"
                                       class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                       placeholder="your.email@mail.com"
                                       value="{{ Auth::user()->email }}"
                                       required>
                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="profession"
                                       class="block mb-2 text-sm font-medium text-indigo-900 ">Role</label>
                                <p class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5
                                cursor-not-allowed
                                ">
                                    {{ Auth::user()->role }}
                                </p>

                            </div>


                            <div class="flex justify-end">
                                <button type="submit"
                                        class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-800">
                                    Save
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div id="div-2" style="display: none;">
                <form action="/user/password-update" method="POST"
                      class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    @csrf
                    @method('PUT')

                    <div class="grid max-w-2xl mx-auto mt-8">
                        <h1 class="font-bold text-xl">Changing Password</h1>
                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                            <!-- Old Password -->
                            <div class="w-full mb-2">
                                @error('old-password')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                                <label for="old-password" class="block mb-2 text-sm font-medium text-indigo-900">Old
                                    password</label>
                                <input type="password" id="old-password" name="old-password"
                                       class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                       placeholder="Type your old password" required>
                            </div>

                            <!-- New Password -->
                            <div class="mb-2">
                                @error('new-password')
                                <p class="text-red-500">{{ $message }}</p>
                                @enderror
                                <label for="new-password" class="block mb-2 text-sm font-medium text-indigo-900">New
                                    Password</label>
                                <input type="password" id="new-password" name="new-password"
                                       class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                       placeholder="Type new password" required>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-2">
                                @error('new-password_confirmation')
                                <p class="text-red-500">{{ $message }}</p>
                                @enderror
                                <label for="new-password-confirmation"
                                       class="block mb-2 text-sm font-medium text-indigo-900">Confirm Password</label>
                                <input type="password" id="new-password-confirmation" name="new-password_confirmation"
                                       class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                       placeholder="Retype the new password" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit"
                                        class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-800">
                                    Save
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </main>
    </div>

    <script>
        let div1 = document.getElementById('div-1');
        let div2 = document.getElementById('div-2');

        function showDiv2() {
            div1.style.display = 'none';
            div2.style.display = 'flex';
        }

        function showDiv1() {
            div1.style.display = 'flex';
            div2.style.display = 'none';
        }

    </script>
@endsection
