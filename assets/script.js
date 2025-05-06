function bookTicket(eventId) {
    fetch('./api/book_ticket.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'event_id=' + encodeURIComponent(eventId)
    })
    .then(res => res.json())
    .then(data => {
        const responseElement = document.getElementById('response');
        responseElement.innerHTML = data.message;

        // Add class based on success or failure
        if (data.success) {
            responseElement.className = 'response success';
        } else {
            responseElement.className = 'response error';
        }

        // Show and then auto-hide response message
        responseElement.style.display = 'block';
        if (data.success) {
            document.getElementById('seats-' + eventId).innerText = data.available_seats;
        }

        setTimeout(() => {
            responseElement.style.display = 'none';
        }, 4000);
    })
    .catch(err => {
        console.error('Error booking ticket:', err);
        const responseElement = document.getElementById('response');
        responseElement.innerHTML = 'An unexpected error occurred.';
        responseElement.className = 'response error';
        responseElement.style.display = 'block';
        setTimeout(() => {
            responseElement.style.display = 'none';
        }, 4000);
    });
}
