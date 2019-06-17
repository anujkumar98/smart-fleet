firebase.auth().onAuthStateChanged(function (user) {
    if (user) {
        var emailVerified=user.emailVerified;
        if(emailVerified){
            window.open("map.php","_self");
        }
    } else {

    }
});
function login() {
    var email = document.getElementById('emailLogin').value;
    var password = document.getElementById('passwordLogin').value;
    firebase.auth().signInWithEmailAndPassword(email, password).then(function() {
        window.open("map.php","_self");
    }).catch(function (error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorCode + " " + errorMessage);
    });
    // var user = firebase.auth().currentUser;
    // var emailVerified=user.emailVerified;
    //     if(emailVerified){
    //         window.open("map.html","_self");
    //     }
    //     else{
    //         alert("Verify your email.");
    //     }
}