function logoutAction() {
    fetch('/index/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(async response => {
            const text = await response.text();
            let data;

            try {
                data = JSON.parse(text);
            } catch (e) {
                throw new Error("Invalid JSON from server");
            }

            if (!response.ok) {
                throw new Error(data.error || 'Unknown server error');
            }

            window.location.href = '/authentication';
        }).catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
}