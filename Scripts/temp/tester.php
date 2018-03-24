<html lang="en">
  <head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="11971063489-r3cr1mos477et9pm4qo2p1qr8m0dh9pc.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        window.location="test.php?ID="+profile.getId()+"&name="+profile.getName()+"&email="+profile.getEmail()+"&img="+profile.getImageUrl()+"&t=G";
      };
    </script>
   <script>
        var url = "test.php?t=F&img=N&email=N";
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '188940791600747',
          xfbml      : true,
          version    : 'v2.8'
        });
        FB.AppEvents.logPageView();

        FB.api('/me', {fields: 'name,email'}, function(response) {
          console.log('Good to see you, ' + response.email + '.');
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
       
       function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }
       function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
          var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
            console.log('uid: ' + response.authResponse.userID);
            console.log('acc: ' + response.authResponse.accessToken);
            document.getElementById('status12').innerHTML = 'userID' +uid;
            url = url + "&ID=" + uid;
          testAPI();
        } else {
          // The person is not logged into your app or we are unable to tell.
          document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
        }
      }
      function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
          console.log('Successful login for: ' + response.name);
          document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
           
            url = url + "&name=" + response.name;
            document.getElementById('status13').innerHTML = url;
            window.location = url;
            });

      }

    </script>
   
    <br>
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>

    <div id="status"><!-- name --> 
       </div>
    <div id="status12"> <!-- ID -->
    </div>
    <div id="status13"> <!-- ID -->
    </div>
  </body>
</html>