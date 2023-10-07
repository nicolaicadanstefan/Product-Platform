document.addEventListener("DOMContentLoaded", function() {
    var deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(event) {
            var selectedCheckboxes = document.querySelectorAll('input[name="delete[]"]:checked');
            if (selectedCheckboxes.length > 0) {

                // Prevent the form from submitting immediately
                event.preventDefault();
                showNotification('The products have been deleted.', 2000, "delete");

                // Delay form submission using a timeout
                setTimeout(function() {
                    deleteForm.submit(); // Submit the form after 1000ms (1 second)
                }, 1000);
            }
        });
    }

    var addForm = document.getElementById('product-form');
    if (addForm) {
        addForm.addEventListener('submit', function(event) {

            // Prevent the form from submitting immediately
            event.preventDefault();
            showNotification('The products have been added successfully.', 2000, "add");

            // Delay form submission using a timeout
            setTimeout(function() {
                addForm.submit(); // Submit the form after 1000ms (1 second)
            }, 1000);
        });
    }
});

function showNotification(message, duration, type) {
    var notification = document.getElementById('notification');
    if (notification) {    
        if (type === "add") {
            notification.style.backgroundColor = '#4CAF50';  // green
        } else if (type === "delete") {
            notification.style.backgroundColor = '#ff2626';  // red
        }
        notification.innerHTML = message;
        notification.style.display = 'block';

        // Hide the notification after the specified duration
        setTimeout(function() {
            notification.style.display = 'none';
        }, duration);
    }
}
