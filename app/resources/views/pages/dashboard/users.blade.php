@extends('layouts.app')
@section('content')

<div id="" class="h-full w-screen flex flex-row justify-between" x-data="{ sidenav: true }">
    @include('layouts.dash-sidebar')

    <p class="text-gray-600 text-sm m-5 text-lg font-bold">Dashboard / <span class="font-normal text-sm"> Users </span></p>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">#</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Email</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Role</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <button id="createUserFormBtn" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="h-fit w-fit m-10 p-2 bg-green-500 border border-green-700 hover:opacity-80 text-white shadow-lg rounded-lg">
        Create User
    </button>

    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create New User
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" id="createNewUserForm">

                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Name</label>
                            <input type="text" name="name" id="name_" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Bashiri" />
                            <p id="nameErr_" class="text-red-500 text-sm" style="display: none;"></p>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Email</label>
                            <input type="email" name="email" id="email_" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="med@bash.com" />
                            <p id="emailErr_" class="text-red-500 text-sm" style="display: none;"></p>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Password</label>
                            <input type="password" name="password" id="password_" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            <p id="passwordErr_" class="text-red-500 text-sm" style="display: none;"></p>
                        </div>
                        <button id="createNewUserBtn" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const accessToken = localStorage.getItem('accessToken');
    const host = 'http://127.0.0.1:8000';

    function fetchUsers() {
        fetch(`${host}/api/users`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${accessToken}`,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const users = data.users;
                const tbody = document.querySelector('tbody');

                tbody.innerHTML = '';

                users.forEach(user => {
                    const tr = document.createElement('tr');
                    tr.classList.add('bg-white', 'border-b', 'transition', 'duration-300', 'ease-in-out', 'hover:bg-gray-100');
                    tr.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${user.user.id}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${user.user.name}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${user.user.email}</td>
                    <td id="user-${user.user.id}-role" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">@${user.role}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        <button class="text-red-500" onclick="deleteUser(${user.user.id})">Delete</button>
                        <button class="text-blue-500" onclick="fetchRolesAndPopulateDropdown(${user.user.id})">Update Role</button>
                    </td>
                `;
                    tbody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    function fetchRolesAndPopulateDropdown(userId) {
        fetch(`${host}/api/roles`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${accessToken}`,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const roles = data.roles;
                const select = document.createElement('select');
                select.classList.add('rounded-md', 'border', 'py-1', 'px-2', 'focus:outline-none', 'focus:border-blue-500');

                roles.forEach(role => {
                    const option = document.createElement('option');
                    option.value = role.name;
                    option.text = role.name;
                    select.appendChild(option);
                });

                const saveButton = document.createElement('button');
                saveButton.textContent = 'Save';
                saveButton.classList.add('text-blue-500', 'ml-2');
                saveButton.addEventListener('click', () => {
                    const selectedRole = select.value;
                    updateRole(userId, selectedRole);
                });

                const div = document.createElement('div');
                div.appendChild(select);
                div.appendChild(saveButton);

                const td = document.querySelector(`#user-${userId}-role`);
                td.innerHTML = '';
                td.appendChild(div);
            })
            .catch(error => console.error('Error:', error));
    }

    function updateRole(userId, newRole) {
        fetch(`${host}/api/user/update/${userId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${accessToken}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    role: newRole
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    fetchUsers();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.log(error));
    }

    function deleteUser(userId) {
        fetch(`${host}/api/user/delete/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${accessToken}`,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    fetchUsers();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.log(error));
    }

    window.onload = function() {
        fetchUsers();
    };

    let createUserFormBtn = document.getElementById('createUserFormBtn');

    const name = document.getElementById('name_');
    const email = document.getElementById('email_');
    const password = document.getElementById('password_');

    let createNewUserBtn = document.getElementById('createNewUserBtn');

    let nameErr = document.getElementById('nameErr_');
    let emailErr = document.getElementById('emailErr_');
    let passwordErr = document.getElementById('passwordErr_');

    document.getElementById('createNewUserForm').addEventListener('submit', function(event) {
        event.preventDefault();
        createNewUser(name.value, email.value, password.value);
    });


    function createNewUser(name, email, password) {

        nameErr.innerHTML = '';
        emailErr.innerHTML = '';
        passwordErr.innerHTML = '';

        createNewUserBtn.innerHTML = 'Loading...';

        fetch(`${host}/api/user/create`, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${accessToken}`
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    password: password
                }),
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                createNewUserBtn.innerHTML = 'Create User';
                if (data.success) {
                    name.value = '';
                    email.value = '';
                    password.value = '';
                    createUserFormBtn.click();
                    alert(data.message);
                    fetchUsers();
                } else {
                    if (data.error) {
                        nameErr.innerHTML = data.error;
                        nameErr.style.display = 'block';
                    } else if (data.errors.name) {
                        nameErr.style.display = 'block';
                        nameErr.innerHTML = data.errors.name[0];
                    } else if (data.errors.email) {
                        emailErr.style.display = 'block';
                        emailErr.innerHTML = data.errors.email[0];
                    } else if (data.errors.password) {
                        passwordErr.style.display = 'block';
                        passwordErr.innerHTML = data.errors.password[0];
                    }
                }
            })
            .catch(error => console.error(error));

    }
</script>



@endsection
