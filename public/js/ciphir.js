// Get modal elements
const modal = document.getElementById('issueModal');
const closeIssueModal = document.querySelector('.close');
const modalTitle = document.querySelector('#modalTitle');

// Infrastructure issues data from the provided image
const infraIssues = {
    "Roads": [
        "Pothole", "Cracked Pavement", "Flooding", "Faded Lane Marking", "Broken Or Damaged Signage", "Malfunctioning Traffic Light",
        "Dangerous Intersection", "Loose Or Missing Manhole Cover", "Bridge Or Overpass Deterioration", "Illegal Parking",
        "Speed Bump", "Roadside", "Traffic Congestion"
    ],
    "Railways": [
        "Track Defect", "Signal Failure", "Track Obstruction", "Station & Platform"
    ],
    "Public Transit System": [
        "Delayed Transport", "Broken Shelters", "Faulty Ticketing", "Overcrowding", "Route Disruptions"
    ],
    "Electric Grids": [
        "Power Outages", "Flickering Lights", "Exposed Wires", "Transformer Issues", "Downed Power Lines", "Voltage Fluctuations"
    ],
    "Pipelines": [
        "Leaking Pipes", "Corroded Pipes", "Pipeline Blockages", "Pipeline Bursts"
    ],
    "Sewage System": [
        "Blocked Sewers", "Sewage Overflows", "Broken Manholes", "Foul Smells", "SewageLeakage"
    ],
    "Storm Water Management": [
        "Clogged Storm Drains", "Erosion", "Damaged Retention Ponds", "Blocked Culverts", "Flooded Areas"
    ],
    "Waste Management": [
        "Missed Waste Collection", "Overflowing Dumpsters", "Illegal Dumping", "Damaged Vehicles", "Hazardous Waste"
    ],
    "Parks": [
        "Damaged Playground Equipment", "Overgrown Landscaping", "Broken Park Benches", "Vandalism", "Park Flooding"
    ]
};

// Function to open the modal and display relevant issues
function openModal(infraType) {
    const issuesList = document.getElementById('issuesList');
    issuesList.innerHTML = '';  // Clear previous issues

    // Update modal title dynamically based on infrastructure type
    const modalTitle = document.querySelector('#modalTitle');
    const formattedTitle = infraType.replace(/([A-Z])/g, ' $1').trim();  // Add spaces before capital letters
    modalTitle.textContent = formattedTitle + " Infrastructure Issues";

    const issues = infraIssues[infraType] || [];
    if (issues.length === 0) {
        issuesList.innerHTML = '<li>No issues reported.</li>';
    } else {
        issues.forEach(issue => {
            const listItem = document.createElement('li');
            listItem.textContent = issue.replace(/([A-Z])/g, ' $1'); // Format camelCase to readable
            issuesList.appendChild(listItem);
        });
    }

    // Show modal and disable background scrolling
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';  // Prevent background scrolling
}

// Add event listeners for view issues buttons
const viewIssuesBtns = document.querySelectorAll('.view-issues-btn');
viewIssuesBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const infraType = this.getAttribute('data-infra');
        openModal(infraType);
    });
});

// Close modal when 'X' is clicked
closeIssueModal.onclick = function() {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';  // Enable background scrolling again
}

// Close modal if clicked outside the modal content
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';  // Enable background scrolling again
    }
}

//*****************************************************************************

// Profile Modal
const profileModal = document.getElementById("profileModal");
const profileButton = document.getElementById("profileButton");
const closeProfileModal = document.querySelector(".close-profile");

// Open Profile Modal
profileButton.onclick = function(event) {
    event.preventDefault();
    profileModal.style.display = "block";
    document.body.style.overflow = "hidden";
};

// Close Profile Modal
closeProfileModal.onclick = function() {
    profileModal.style.display = "none";
    document.body.style.overflow = "auto";
};

window.onclick = function(event) {
    if (event.target == profileModal) {
        profileModal.style.display = "none";
        document.body.style.overflow = "auto";
    }
};

// Edit Profile Modal
const editModal = document.getElementById("editProfileModal");
const editIcons = document.querySelectorAll(".edit-icon");
const closeModalButton = document.querySelector(".modal-content-edit .close");
const saveButton = document.getElementById("saveProfileButton");
const cancelButton = document.getElementById("cancelEditButton");

// Open Edit Modal
editIcons.forEach(function(icon) {
    icon.addEventListener("click", function() {
        editModal.style.display = "block";
        document.body.style.overflow = "hidden";
    });
});

// Close Edit Modal
closeModalButton.onclick = function() {
    editModal.style.display = "none";
    document.body.style.overflow = "auto";
};

cancelButton.onclick = function() {
    editModal.style.display = "none";
    document.body.style.overflow = "auto";
};

// Save Profile Changes
saveButton.onclick = function() {
    const updatedUsername = document.getElementById("editUsername").value;
    const updatedPassword = document.getElementById("editPassword").value;

    // Save logic goes here
    alert(`Profile Updated: Username = ${updatedUsername}, Password = ${updatedPassword}`);

    editModal.style.display = "none";
    document.body.style.overflow = "auto";
};