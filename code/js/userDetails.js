function logout() {

    firebase.auth().signOut().then(function () {
        window.open("login.html", "_self");
    }).catch(function (error) {
        alert("Error: " + error);
    });
}
function getDetails() {
    var user = firebase.auth().currentUser;
    var name, email, photoUrl, uid, emailVerified;

    if (user != null) {
        name = user.displayName;
        email = user.email;
        photoUrl = user.photoURL;
        emailVerified = user.emailVerified;
        uid = user.uid;
        document.getElementById("userName").innerHTML=email;
        alert(name);

    }
    if (user != null) {
        user.providerData.forEach(function (profile) {
          console.log("Sign-in provider: " + profile.providerId);
          console.log("  Provider-specific UID: " + profile.uid);
          console.log("  Name: " + profile.displayName);
          console.log("  Email: " + profile.email);
          console.log("  Photo URL: " + profile.photoURL);
        });
      }
}

window.onload=getDetails;