document.addEventListener("DOMContentLoaded", function() {
    // Initialize the stars for feedback
    const starContainer = document.getElementById('stars');
    const starCount = 5;

    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('span');
        star.innerHTML = '★';
        star.style.color = (i < 0) ? 'gold' : 'gray';  // 4 out of 5 stars rated
        star.style.fontSize = '20px';
        star.style.marginRight = '5px';
        starContainer.appendChild(star);
    }

    // Back button logic
    document.getElementById('back-btn').addEventListener('click', function() {
        window.history.back();
    });

    // Complete button logic
    document.getElementById('complete-btn').addEventListener('click', function() {
        alert('Report marked as complete!');
    });
});

$(document).ready(function() {
    $('#complete-btn').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get the selected status and report number
        const status = $('#status').val();
        const reportNo = '{{ $report->report_no }}';

        // Debugging: Log the status and reportNo to ensure they're being captured
        console.log('Selected status:', status);
        console.log('Report No:', reportNo);

        $.ajax({
            url: '/report/' + reportNo + '/update-status', // URL construction
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                'reportdetail-status': status
            },
            success: function(response) {
                // Success callback
                alert('Status updated successfully!');
            },
            error: function(xhr, status, error) {
                // Error callback
                alert('Error updating status: ' + error);
            }
        });
    });
});
