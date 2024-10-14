var modal = document.getElementById("profileModal");
var btn = document.getElementById("profileButton");
var span = document.getElementsByClassName("close")[0];
var modalImg = document.getElementById("modalProfilePic");
var logoutButton = document.getElementById("logoutButton");

// Open the modal when the user clicks the profile button
btn.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";

    document.body.style.overflow = "hidden";

    // Set the modal image source to match the admin profile picture
    var adminPicSrc = document.getElementById("adminProfilePic").src;
    modalImg.src = adminPicSrc;
}

// Close the modal when the user clicks the close (x) button
span.onclick = function() {
    modal.style.display = "none";

    document.body.style.overflow = "auto";
}


// Close the modal when the user clicks outside the modal content
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Redirect to main page when logout button is clicked
logoutButton.onclick = function() {
    window.location.href = "/";
}



// Manage Your Account
var editModal = document.getElementById("editModal");
var manageAccountLink = document.getElementById("manageAccount");
var cancelButton = document.getElementById("cancelButton");
var content = document.querySelector('.content');

// Open the edit modal when the manage account link is clicked
manageAccountLink.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "none"; // Close profile modal
    editModal.style.display = "block"; // Open edit modal
    content.classList.add('blur');
}

// Close the edit modal when the close (x) button is clicked
cancelButton.onclick = function() {
    editModal.style.display = "none";
    content.classList.remove('blur');
}

// Close the edit modal when the user clicks outside the modal content
window.onclick = function(event) {
    if (event.target == editModal) {
        editModal.style.display = "none";
        content.classList.remove('blur');
    }
}

// Handle the save button click
document.getElementById("saveButton").onclick = function() {
    var empId = document.getElementById("employeeId").value;
    var email = document.getElementById("email").value;

    // Example: Print to console (replace with your actual save logic)
    console.log("Employee ID:", empId);
    console.log("Email:", email);

    // Close the modal after saving
    editModal.style.display = "none";
    content.classList.remove('blur');
}


document.getElementById("newReportLink").onclick = function(event) {
event.preventDefault();
document.getElementById("homeContent").style.display = "none";
document.getElementById("newReportsContent").style.display = "block";

// Update active link styling
document.getElementById("homeLink").classList.remove("active");
this.classList.add("active");
};

document.getElementById("homeLink").onclick = function(event) {
event.preventDefault();
document.getElementById("newReportsContent").style.display = "none";
document.getElementById("homeContent").style.display = "block";

// Update active link styling
document.getElementById("newReportLink").classList.remove("active");
this.classList.add("active");
};


var ctx = document.getElementById('infraChart').getContext('2d');
var infraChart = new Chart(ctx, {
type: 'bar',
data: {
    labels: ['Roads', 'Railways', 'Public Transit', 'Electric Grids', 'Pipelines', 'Drainage', 'Storm Water Management', 'Waste Management', 'Parks'],
    datasets: [{
        label: 'Common Infrastructure Type Reported',
        data: [40, 10, 50, 80, 30, 40, 15, 30, 25],
        backgroundColor: [
            '#ff6384',
            '#36a2eb',
            '#ffcd56',
            '#4bc0c0',
            '#9966ff',
            '#ff9f40',
            '#ff6384',
            '#36a2eb',
            '#ffcd56'
        ],
        borderColor: [
            '#ff6384',
            '#36a2eb',
            '#ffcd56',
            '#4bc0c0',
            '#9966ff',
            '#ff9f40',
            '#ff6384',
            '#36a2eb',
            '#ffcd56'
        ],
        borderWidth: 1
    }]
},
options: {
    scales: {
        x: {
            beginAtZero: true,
            grid: {
                display: false
            }
        },
        y: {
            beginAtZero: true
        }
    }
}
})


document.addEventListener('DOMContentLoaded', function () {
const notificationIcon = document.getElementById('notification');
const notificationSidebar = document.getElementById('notificationSidebar');
const closeNotification = document.getElementById('closeNotification');

// Hide the notification panel by default
notificationSidebar.style.right = '-400px'; // Push it off screen by default

// Show the notification panel when the bell icon is clicked
notificationIcon.addEventListener('click', function (e) {
    e.preventDefault(); // Prevent default anchor link behavior
    if (notificationSidebar.style.right === '0px') {
        notificationSidebar.style.right = '-400px'; // Close the sidebar
    } else {
        notificationSidebar.style.right = '0px'; // Open the sidebar
    }
});

// Close the notification panel when the close button is clicked
closeNotification.addEventListener('click', function () {
    notificationSidebar.style.right = '-400px'; // Push it off screen to hide
})
});
