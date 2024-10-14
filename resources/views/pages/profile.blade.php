<!-- <!DOCTYPE html>
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

    <div id="editModal" class="modal">
            <div class="modal-content-edit">
                <span class="close">&times;</span>
                <h3>Profile Information</h3>
                <div class="input-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" value="ciphir_admin" readonly>
                            <span class="edit-icon"><i class="fas fa-edit"></i></span>
                        </div>

                        <div class="input-group">
                            <label for="oldPassword">Old Password</label>
                            <input type="password" id="oldPassword" value="********" readonly>
                            <span class="edit-icon"><i class="fas fa-edit"></i></span>
                        </div>

                        <div class="input-group" style="display:none;" id="newPasswordFields">
                            <label for="newPassword">New Password</label>
                            <input type="password" id="newPassword" placeholder="Enter New Password">
                        </div>

                        <div class="input-group" style="display:none;" id="confirmPasswordFields">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" id="confirmPassword" placeholder="Confirm New Password">
                        </div>
                        <div class="button-group" id="buttons" style="display:none;">
                            <button id="saveButton">Save</button>
                            <button id="cancelButton">Cancel</button>
                        </div>
                    </div>
                </div>

</body>
</html> -->
