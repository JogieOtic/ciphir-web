// script.js
document.addEventListener('DOMContentLoaded', () => {
    const notificationItems = document.querySelectorAll('.notification-item');
    
    notificationItems.forEach(item => {
        document.querySelector('.notification-panel-close').addEventListener('click', function() {
            document.querySelector('.notification-panel').style.display = 'none';
        });
    });
});
