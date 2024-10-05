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



// Profile Modal Elements
const profileModal = document.getElementById("profileModal");
const profileButton = document.getElementById("profileButton");
const closeProfileModal = document.querySelector(".close-profile"); // Update selector for profile modal close button

// Function to open the profile modal and position it below the profile picture
profileButton.onclick = function(event) {
    event.preventDefault();
    profileModal.style.display = "block";
    
    // Position the modal below the profile picture
    profileModal.style.position = "absolute";
    const profilePicRect = profileButton.getBoundingClientRect(); // Get the profile picture's position
    profileModal.style.top = (profilePicRect.bottom + window.scrollY) + "px"; // Position below the image
    profileModal.style.left = (profilePicRect.left - 100) + "px"; // Slight offset to the left for centering

    // Disable background scrolling
    document.body.style.overflow = "hidden";
};

// Close the profile modal when 'X' is clicked
closeProfileModal.onclick = function() {
    profileModal.style.display = "none";
    document.body.style.overflow = "auto";  // Enable background scrolling again
};

// Close the profile modal if clicked outside the modal content
window.onclick = function(event) {
    if (event.target == profileModal) {
        profileModal.style.display = "none";
        document.body.style.overflow = "auto";
    }
};

const ctx = document.getElementById('infraChart').getContext('2d');
const infraChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Roads', 'Railways', 'Public Transit', 'Electric Grids', 'Pipelines', 'Drainage', 'Storm Water Management', 'Waste Management', 'Parks'],
        datasets: [{
            label: 'Common Infrastructure Type Reported',
            data: [90, 10, 40, 80, 30, 50, 20, 45, 15],
            backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff', '#ff9f40', '#ff6384', '#36a2eb', '#ffcd56'],
        }]
    },
    options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
            x: {
                ticks: {
                    color: 'white',
                    font: {
                        size: 12
                    }
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'  // Optionally set the grid color (lighter white)
                }
            },
            y: {
                ticks: {
                    color: 'white',  // Set the color of the y-axis labels to white
                    font: {
                        size: 12  // Optionally set the font size
                    }
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'  // Optionally set the grid color (lighter white)
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: 'white',  // Set the legend text color to white
                    font: {
                        size: 14  // Optionally set the font size
                    }
                }
            }
        }
    }
});