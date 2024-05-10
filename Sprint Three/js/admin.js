/*Team Name: MRS Tech
	Team Member: Andrew Millett
	Date: 09/05/2024*/

$(document).ready(function() {
    // Event listener for form submission
    $('#form-login').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the values entered by the user
        var inputUsername = $('#input-username').val();
        var inputPassword = $('#input-password').val();

        // Hard-coded username and password for authentication
        var validUsername = "Admin";
        var validPassword = "P@ssw0rd";

        // Check if the entered username and password match the valid ones
        if (inputUsername === validUsername && inputPassword === validPassword) {
            // Redirect the user to the proper page (replace 'proper-page.html' with the actual page URL)
            window.location.href = 'users.php';
        } else {
            // Display an error message or handle authentication failure as needed
            alert('Invalid username or password');
			// Sends to the same page as a form of reset
			window.location.href = 'admin.php'
        }
    });
});