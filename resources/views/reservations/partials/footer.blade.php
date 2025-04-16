
        </div>
    </div>


    <!-- jQuery and Bootstrap JS Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Calculate nights when arrival or departure dates change
            $('input[name="arrival"], input[name="departure"]').change(function() {
                const arrival = new Date($('input[name="arrival"]').val());
                const departure = new Date($('input[name="departure"]').val());
                
                if(arrival && departure) {
                    const diffTime = Math.abs(departure - arrival);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    $('input[name="nights"]').val(diffDays);
                }
            });
            
            // Calculate total pax
            $('input[name="adults"], input[name="children"], input[name="juniors"]').change(function() {
                const adults = parseInt($('input[name="adults"]').val()) || 0;
                const children = parseInt($('input[name="children"]').val()) || 0;
                const juniors = parseInt($('input[name="juniors"]').val()) || 0;
                $('input[name="totalPax"]').val(adults + children + juniors);
            });
            
            // Room type selection
            $('.room-type-cell').click(function() {
                $('.room-type-cell').removeClass('bg-primary text-white');
                $(this).addClass('bg-primary text-white');
                // Here you would update the room selection logic
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.getElementById('paymentBody');

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.payment-amount').forEach(input => {
            const val = parseFloat(input.value);
            if (!isNaN(val)) total += val;
        });
        document.getElementById('totalAmount').innerText = `$${total.toFixed(2)}`;
    }

    tableBody.addEventListener('click', function (e) {
        // Add new row
        if (e.target.closest('.add-row')) {
            const currentRow = e.target.closest('tr');
            const newRow = currentRow.cloneNode(true);

            newRow.querySelectorAll('input, select').forEach(el => {
                el.value = '';
            });

            newRow.querySelector('.add-row').outerHTML = `
                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash"></i></button>
            `;

            tableBody.insertBefore(newRow, tableBody.lastElementChild); // before TOTAL row
            calculateTotal();
        }

        // Remove row
        if (e.target.closest('.remove-row')) {
            const row = e.target.closest('tr');
            row.remove();
            calculateTotal();
        }
    });

    // Recalculate total on amount input
    tableBody.addEventListener('input', function (e) {
        if (e.target.classList.contains('payment-amount')) {
            calculateTotal();
        }
    });

    // Initialize total on page load
    calculateTotal();
});
document.getElementById('btnPrint').addEventListener('click', function () {
        sendVoucherRequest("{{ route('voucher.print') }}");
    });

    document.getElementById('btnDuplicate').addEventListener('click', function () {
        sendVoucherRequest("{{ route('voucher.duplicate') }}");
    });

    document.getElementById('btnAmend').addEventListener('click', function () {
        sendVoucherRequest("{{ route('voucher.amend') }}");
    });

    document.getElementById('btnEmail').addEventListener('click', function () {
        sendVoucherRequest("{{ route('voucher.email') }}");
    });

    function sendVoucherRequest(url) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ /* data if needed */ })
        }).then(response => response.json())
          .then(data => {
              alert(data.message || 'Request completed');
          }).catch(err => {
              alert('Error occurred');
          });
    }
    // Confirm reservation button
    document.getElementById('btnConfirm').addEventListener('click', function () {
    var reservationId = this.getAttribute('data-id'); // Get the reservation ID from the button

    if (confirm('Are you sure you want to confirm this reservation?')) {
        // Construct the URL with the reservation ID
        fetch("/reservations/" + reservationId + "/confirm", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert('Reservation confirmed!');
            location.reload(); // Refresh the page or redirect as needed
        })
        .catch(error => alert('Error confirming reservation: ' + error));
    }
});

    // Delete reservation button
//     document.getElementById('btnDelete').addEventListener('click', function () {
//     var reservationId = this.getAttribute('data-id'); // Get the reservation ID dynamically
//     if (confirm('Are you sure you want to delete this reservation?')) {
//         fetch("/reservations/" + reservationId, {
//             method: 'DELETE',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             alert('Reservation deleted successfully!');
//             location.reload(); // Refresh the page or redirect as needed
//         })
//         .catch(error => alert('Error deleting reservation: ' + error));
//     }
// });


    // Save changes button
    // document.querySelector('.btn-primary').addEventListener('click', function (e) {
    //     e.preventDefault(); // Prevent default form submission

    //     // Get the form data
    //     const form = document.querySelector('form');
    //     const formData = new FormData(form);

    //     // Submit the data via AJAX to save
    //     fetch("{{ route('reservations.store', $reservation) }}", {
    //         method: 'POST',
    //         body: formData,
    //         headers: {
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         alert('Changes saved!');
    //         location.reload(); // Refresh the page or handle accordingly
    //     })
    //     .catch(error => alert('Error saving changes: ' + error));
    // });
    </script>
</body>
</html>
