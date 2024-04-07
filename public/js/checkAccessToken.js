document.addEventListener('DOMContentLoaded', function() {

    checkAccessToken();

    function checkAccessToken() {
        const accessToken = localStorage.getItem('accessToken');

        if (!accessToken) {
            if (window.location.pathname === '/dashboard') {
                window.location.href = '/login';
                console.log('Unauthenticated');
            }
            return;
        }

        fetch('http://127.0.0.1:8000/api/auth/check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${accessToken}`
            },
        })
            .then(response => {
                if (!response.ok) {
                    if (window.location.pathname === '/dashboard') {
                        window.location.href = '/login';
                        console.log('Unauthenticated');
                    }
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (window.location.pathname === '/login' || window.location.pathname === '/register') {
                        window.location.href = '/';
                    }
                    if (data.user.roles[0].name !== 'SuperAdmin' && window.location.pathname === '/dashboard') {
                        window.location.href = '/';
                    }

                }
            })
            .catch(error => {
                console.error(error);
            });

    }

});
