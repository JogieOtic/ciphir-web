<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIPHIR Website</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="/css/mainpage.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>

</head>
<body>
    <x-header />
    <div class="pt-10">...</div>
    <x-hero />

    <!-- Google Play Button
    <section class="google">
        <div class="google-play-container">
            <div class="text-container">
                Do you have any issues near you?
            </div>
            <div class="download-section">
                <span class="download-text">Download the Mobile App Now:</span>
                <a href="https://play.google.com/store" target="_blank">
                    <img class="google-play-img" src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Download on Google Play">
                </a>
            </div>
        </div>
    </section> -->

    <!-- News and Updates -->
    <section id="news-updates" class="news-updates">
    <h2>Infrastructure</h2>
    <div class="news-grid">
        <div class="news-card">
            <img src="/img/Road.png" alt="Road Issues">
            <div class="news-card-content">
                <h3>Roads</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Roads">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Railway.png" alt="Railways Issues">
            <div class="news-card-content">
                <h3>Railways</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Railways">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Public Transit.png" alt="Public Transit System Issues">
            <div class="news-card-content">
                <h3>Public Transit System</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Public Transit System">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Electric Grids.png" alt="Electric Grids Issues">
            <div class="news-card-content">
                <h3>Electric Grids</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Electric Grids">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Pipelines.png" alt="Pipelines Issues">
            <div class="news-card-content">
                <h3>Pipelines</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Pipelines">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Sewage System.png" alt="Sewage System Issues">
            <div class="news-card-content">
                <h3>Sewage System</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Sewage System">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Storm Water Management.png" alt="Stormwater Management Issues">
            <div class="news-card-content">
                <h3>Stormwater Management</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Storm Water Management">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Waste Management.png" alt="Waste Management Issues">
            <div class="news-card-content">
                <h3>Waste Management</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Waste Management">View Issues</a>
            </div>
        </div>
        <div class="news-card">
            <img src="/img/Park.png" alt="Parks Issues">
            <div class="news-card-content">
                <h3>Parks</h3>
                <a href="#news-updates" class="view-issues-btn" data-infra="Parks">View Issues</a>
            </div>
        </div>
    </div>
</section>


    <!-- Public Safety Office Section -->
    <section id="public-safety" class="public-safety">
        <h2>Public Safety Office</h2>
        <div class="public-safety-details">
            <!-- <img src="/img/person1.png" alt="PS Officer"> -->
            <div class="contact-info">
                <h3>Mr. Renne F. Gumba</h3>
                <p>CDGHI I / Executive Officer</p>
                <hr>
                <p>Address: Public Safety Office, G/F Raul S. Roco Library Bldg., Naga City Hall Complex, Naga City</p>
                <p>Phone: +63-54-871-2050 (local number)</p>
                <p>Email: pso@naga.gov.ph</p>
            </div>
        </div>
    </section>

    <!-- Modal HTML -->
    <div id="issueModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Updated Title Element -->
            <h2 id="modalTitle">Infrastructure Issues</h2>
            <ul id="issuesList">
                <!-- Issue items will be injected here -->
            </ul>
        </div>
    </div>

    <footer>
        <p>© 2024 CIPHIR Project, Ateneo Avenue, Naga City, 4400 Philippines</p>
    </footer>

    <script src="/js/ciphir.js"></script>
</body>
</html>
