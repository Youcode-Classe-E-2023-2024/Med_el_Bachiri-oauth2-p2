@extends('layouts.app')
@section('content')
    <div class="h-full w-screen flex flex-row justify-between">
        @include('layouts.dash-sidebar')

        <p class="text-gray-600 text-sm m-5 text-lg font-bold">Dashboard / <span
                class="font-normal text-sm"> Roles </span></p>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-200 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">#</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Permissions
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody id="roleTableBody">
                            <!-- Roles will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <button id="createRoleFormBtn" data-modal-target="role-modal" data-modal-toggle="role-modal" type="button"
                class="h-fit w-fit m-10 p-2 bg-green-500 border border-green-700 hover:opacity-80 text-white shadow-lg rounded-lg">
            Create Role
        </button>

        <div id="role-modal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Create New Role
                        </h3>
                        <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="role-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" id="createNewRoleForm">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                                    Name</label>
                                <input type="text" name="name" id="role_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       placeholder="Admin"/>
                                <p id="nameErr_" class="text-red-500 text-sm" style="display: none;"></p>
                            </div>
                            <div>
                                <label for="create-role_permissions"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>
                                <select multiple name="permissions" id="create-role_permissions"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    {{--                                display permissions here after fetch --}}
                                </select>
                                <p id="permissionsErr_" class="text-red-500 text-sm" style="display: none;"></p>
                            </div>
                            <button id="createNewRoleBtn"
                                    class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Create Role
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const accessToken = localStorage.getItem('accessToken');
        const host = 'http://127.0.0.1:8000';

        function fetchRoles() {
            fetch(`${host}/api/roles`, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${accessToken}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    const roles = data.roles;
                    const tbody = document.getElementById('roleTableBody');

                    tbody.innerHTML = '';

                    roles.forEach(role => {
                        const tr = document.createElement('tr');
                        tr.classList.add('bg-white', 'border-b', 'transition', 'duration-300', 'ease-in-out', 'hover:bg-gray-100');
                        tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${role.id}</td>
                        <td id="td-roleName-${role.id}" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${role.name}</td>
                        <td id="td-permissions-${role.id}" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            ${role.permissions.map(permission => permission.name).join(', ')}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <button class="text-red-500" onclick="deleteRole(${role.id})">Delete</button>
                            <button class="text-blue-500" onclick="updateRole(${role.id})">Update</button>
                        </td>
                    `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Error:', error));
        }


        function deleteRole(roleId) {
            fetch(`${host}/api/role/delete/${roleId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${accessToken}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        fetchRoles();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error(error));
        }

        let createRoleFormBtn = document.getElementById('createRoleFormBtn');

        const name = document.getElementById('role_name');
        let permissions = document.getElementById('create-role_permissions');

        let createNewRoleBtn = document.getElementById('createNewRoleBtn');

        let nameErr = document.getElementById('nameErr_');
        let permissionsErr = document.getElementById('permissionsErr_');

        window.onload = function () {
            fetchRoles();
            fetchPermissions();
        };


        document.getElementById('createNewRoleForm').addEventListener('submit', function (event) {
            event.preventDefault();
            let x = Array.from(permissions.selectedOptions).map(option => option.value);
            // console.log(x);
            createNewRole(name.value, x);
        });


        function createNewRole(name, permissions) {
            createNewRoleBtn.innerHTML = 'Loading...';
            fetch(`${host}/api/role/create`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${accessToken}`
                },
                body: JSON.stringify({
                    name: name,
                    permissions: permissions
                })
            })
                .then(response => response.json())
                .then(data => {
                    createNewRoleBtn.innerHTML = 'Create Role';
                    if (data.success) {
                        name.value = '';
                        permissions.value = '';
                        createRoleFormBtn.click();
                        alert(data.message);
                        fetchRoles();
                    } else {
                        if (data.errors.name) {
                            nameErr.innerHTML = data.error;
                            nameErr.style.display = 'block';
                        } else if (data.errors.permissions) {
                            permissionsErr.style.display = 'block';
                            permissionsErr.innerHTML = data.errors.permissions[0];
                        }
                    }
                })
                .catch(error => console.error(error));
        }

        let FetchedPermissions = [];

        function fetchPermissions() {
            fetch(`${host}/api/permissions`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${accessToken}`,
                    'Content-Type': 'application/json'
                },
            })
                .then(response => response.json())
                .then((data) => {
                    if (data.success) {
                        FetchedPermissions = data.permissions;
                        FetchedPermissions.forEach(permission => {
                            permissions.innerHTML += `
                                    <option value="${permission.id}">${permission.name}</option>
                                `;
                        });
                    } else {
                        alert('error fetching permissions.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function updateRole(roleId) {
            let p = document.getElementById('td-permissions-' + roleId);
            let r = document.getElementById('td-roleName-' + roleId);
            let select = document.createElement('select');
            select.multiple = true;
            let options = [];
            FetchedPermissions.forEach(prm => {
                let option = document.createElement('option');
                option.text = prm.name;
                option.value = prm.id;
                select.appendChild(option);
            });

            p.innerHTML = '';
            p.appendChild(select);

            let save = document.createElement('button');
            save.type = 'button';
            save.classList.add('text-green-500', 'm-5', 'text-lg', 'hover:underline');
            save.innerHTML = 'save';
            p.appendChild(save);

            let input = document.createElement('input');
            input.value = r.textContent;
            r.innerHTML = '';
            r.appendChild(input);


            save.addEventListener('click', () => {
                let sp = Array.from(select.selectedOptions).map(option => option.value);
                // console.log('options' ,sp);
                // // console.log('input' , input.value);
                console.log(roleId);
                let roleUPName = input.value;
                fetch(`${host}/api/role/update/${roleId}`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: roleUPName,
                        permissions: sp
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            fetchRoles();
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.log(error));
            });

        }
    </script>

@endsection
