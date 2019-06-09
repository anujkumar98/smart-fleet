function register() {
    var email = document.getElementById('emailRegister').value;
    var password = document.getElementById('passwordRegister').value;
    var confirmPassword = document.getElementById('confirmPasswordRegister').value;
    if (password == confirmPassword) {
        firebase.auth().createUserWithEmailAndPassword(email, password).catch(function (error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            window.alert("Error: " + errorCode + " " + errorMessage);
        });
        alert("Registered");
        var user = firebase.auth().currentUser;
        user.sendEmailVerification().then(function() {
        }).catch(function(error) {
        alert("Error: "+error);
});
        alert("Verify your email and login.");
     window.open("login.html","_self");
    }
    else {
        alert("Pasword do not match.");
    }
}
