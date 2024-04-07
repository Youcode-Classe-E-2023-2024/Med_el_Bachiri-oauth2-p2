<!-- component -->
<nav class="bg-white shadow dark:bg-gray-800 flex">
    <a href="/" class="text-xl w-[10rem] flex items-center justify-center text-blue-800 dark:text-blue-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Oauth2 P2</a>

    <div class="container flex items-center justify-center p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
        <a href="/" class="text-gray-800 dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">home</a>

        <a href="#" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">features</a>

        <a href="#" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">pricing</a>

        <a href="#" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">blog</a>

    </div>
    <div id="authDiv" class="flex justify-center items-center text-white p-2">

        <a href="/login" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">Login</a>

        <a href="/register" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">Register</a>

    </div>
</nav>
<script>
    let authDiv = document.getElementById('authDiv');
    fetch('http://127.0.0.1:8000/api/auth/check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('accessToken')}`
        },
    })
        .then(response => {
            if (!response.ok) {
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                authDiv.innerHTML = `
                    <div class="w-56 pb-1">
                        <p class="text-xs px-5">${data.user.name} | ${data.user.email}</p>
                        <p class="text-xs text-center px-3 text-blue-500 border-t-2 border-blue-500">${data.user.roles[0].name}</p>
                    </div>
                    <div class="flex items-center justify-center text-center">
                         <button onclick="logout()" class="border-b-2 text-red-500 nsparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-red-500 mx-1.5 sm:mx-6">Logout</button>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error(error);
        });

    function logout() {
        fetch('http://127.0.0.1:8000/api/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('accessToken')}`
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('logout not ok.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    localStorage.removeItem('accessToken');
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
<?php /**PATH C:\Users\YouCode\Desktop\Med_el_Bachiri-oauth2-p2\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>