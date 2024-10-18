// Display a login success message
window.addEventListener('load', function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('login_success')) {
        alert('Login Successful!');
    }
});

// Confirm logout action
function confirmLogout() {
    return confirm('Are you sure you want to log out?');
}
