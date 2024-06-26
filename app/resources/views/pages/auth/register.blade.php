@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <div class="flex flex-col h-screen bg-gradient-to-b from-[#063970] to-blue-200">
        <div class="grid place-items-center mx-2 my-20 sm:my-auto" x-data="{ showPass: true, errorMessage: '' }">
            <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
                px-6 py-10 sm:px-10 sm:py-6
                bg-white rounded-lg shadow-md lg:shadow-lg">
                <div class="text-center mb-4">
                    <h6 class="font-semibold text-[#063970] text-xl">Register</h6>
                </div>
                <form class="space-y-5" id="registerForm">
                    <p id="nameErr" class="text-red-500 text-sm" style="display: none"></p>
                    <div>
                        <input id="name" type="text" name="name" placeholder="Name" class="block w-full py-3 px-3 mt-2
                            text-gray-800 appearance-none
                            border-2 border-gray-100
                            focus:text-gray-500 focus:outline-none focus:border-gray-200 rounded-md" />
                    </div>
                    <p id="emailErr" class="text-red-500 text-sm" style="display: none"></p>
                    <div>
                        <input id="email" type="email" name="email" placeholder="Email" class="block w-full py-3 px-3 mt-2
                            text-gray-800 appearance-none
                            border-2 border-gray-100
                            focus:text-gray-500 focus:outline-none focus:border-gray-200 rounded-md" />
                    </div>

                    <div class="relative w-full">
                        <p id="passwordErr" class="text-red-500 text-sm" style="display: none"></p>
                        <input :type="showPass ? 'password' : 'text'" id="password" name="password" placeholder="Password" class="block w-full py-3 px-3 mt-2 mb-4
                            text-gray-800 appearance-none
                            border-2 border-gray-100
                            focus:text-gray-500 focus:outline-none focus:border-gray-200 rounded-md" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                            <p class="font-semibold" @click="showPass = !showPass" x-text ="showPass ? 'Show' : 'Hide'">Show</p>
                        </div>
                    </div>

                    <p class="text-red-500 text-sm" x-text="errorMessage" x-show="errorMessage"></p>

                    <button id="registerBtn" type="button" class="w-full py-3 mt-10 bg-[#063970] rounded-md
                        font-medium text-white uppercase
                        focus:outline-none hover:shadow-none" @click.prevent="register">
                        Register
                    </button>
                </form>
                <a href="/login" class="text-xs">Already have an account? <span class="text-blue-600 underline">Login</span></a>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    <script>
        let registerBtn = document.getElementById('registerBtn');
        let nameErr = document.getElementById('nameErr');
        let emailErr = document.getElementById('emailErr');
        let passwordErr = document.getElementById('passwordErr');
        function register() {
            registerBtn.innerHTML = 'loading...';
            nameErr.innerHTML = '';
            emailErr.innerHTML = '';
            passwordErr.innerHTML = '';

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('http://127.0.0.1:8000/api/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, email, password }),
            })
                .then(response =>  response.json())
                .then(data => {
                    registerBtn.innerHTML = 'register';
                    if (!data.success) {
                        nameErr.style.display = 'block';
                        emailErr.style.display = 'block';
                        passwordErr.style.display = 'block';
                        if (data.errors.name) {
                            nameErr.innerHTML = data.errors.name[0];
                        }
                        if (data.errors.email) {
                            emailErr.innerHTML = data.errors.email[0];
                        }
                        if (data.errors.password) {
                            passwordErr.innerHTML = data.errors.password[0];
                        }
                    }
                    if (data.success) {
                        alert('user created successfully.')
                        window.location.href = '/login';
                    }

                })
                .catch(error => console.log(error));
        }

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            register();
        });
    </script>
@endsection
