
window.addEventListener("pageshow", function(event) {
    if (event.persisted || window.performance && window.performance.navigation.type === 2) {
        // Force a page reload
        window.location.reload();
    }
});
// Automatically hide success and error alerts after 3 seconds
setTimeout(() => {
    const successAlert = document.getElementById('alert-success');
    const errorAlert = document.getElementById('alert-error');

    if (successAlert) successAlert.style.display = 'none';
    if (errorAlert) errorAlert.style.display = 'none';
}, 3000); // 3000ms = 3 seconds

// Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function () {
  // Select the Flowbite datepicker
  const startDatepicker = document.querySelector('#datepicker-range-start');
  const endDatepicker = document.querySelector('#datepicker-range-end');

  // Function to apply w-full to the calendar days
  function applyFullWidthDays() {
      // Wait for the dynamically generated calendar days to appear
      setTimeout(() => {
          const days = document.querySelectorAll('.days'); // Replace with Flowbite's actual day class
          days.forEach(day => {
              day.classList.add('w-full'); // Add w-full class
          });
      }, 100); // Adjust delay if needed
  }

  // Attach event listeners for when the datepicker is opened
  startDatepicker.addEventListener('focus', applyFullWidthDays);
  endDatepicker.addEventListener('focus', applyFullWidthDays);
});


