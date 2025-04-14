// public/js/validations.js

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('safariBookingForm');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        // Validate required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(function(field) {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        const departureDateInput = document.getElementById('departureDate');
        const arrivalDateInput = document.getElementById('arrivalDate');
    
        departureDateInput.addEventListener('change', function () {
            const arrivalDate = new Date(arrivalDateInput.value);
            const departureDate = new Date(departureDateInput.value);
    
            if (departureDate <= arrivalDate) {
                alert('Departure date must be after arrival date');
                departureDateInput.value = '';
            }
        });

        // Validate date fields
        const arrivalDate = document.getElementById('arrivalDate').value;
        const departureDate = document.getElementById('departureDate').value;

        if (arrivalDate && departureDate) {
            if (new Date(arrivalDate) >= new Date(departureDate)) {
                isValid = false;
                alert('Departure date must be after arrival date');
                document.getElementById('departureDate').classList.add('is-invalid');
            } else {
                document.getElementById('departureDate').classList.remove('is-invalid');
            }
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            alert('Please fill in all required fields correctly.');
        }
    });

    // Optional: Save draft functionality
    document.getElementById('saveDraftBtn').addEventListener('click', function() {
        const formData = new FormData(form);
        // Save draft logic (e.g., send to server via AJAX)
        alert('Draft saved successfully!');
    });
});