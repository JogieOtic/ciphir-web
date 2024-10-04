<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - CIPHIR</title>
    <link href="/css/profilepage.css" rel="stylesheet">
</head>
<body>
<header>
        <div class="container">
            <div class="logo">
                <img src="/img/Web System logo.png" alt="CIPHIR Logo">
                <p>Empowering Communities<br>Through Connection and Collaboration</p>
            </div>
            <div class="user">
                <p>Welcome, ADMIN</p>
                <a href="dashboard" target="_blank">
                    <img src="img/Web System logo.png" alt="User Profile">
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="profile-card">
            <h2>Profile Information</h2>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Employee ID">
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email">
                        <button class="edit-btn">
                            <img src="/img/edit-icon.png" alt="Edit">
                        </button>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="admin@ciphir.com" readonly>
                </div>
                <div class="button-group">
                    <button type="submit" class="save-btn">Save</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>