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
