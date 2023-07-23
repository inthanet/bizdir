<?php
$admin_google_client_id = $footer_row['admin_google_client_id'];
$admin_google_client_secret = $footer_row['admin_google_client_secret'];
?>

<script src="https://accounts.google.com/gsi/client" async defer></script>
    </div>
    <?php echo $admin_google_client_id; ?>
    <div id="g_id_onload"
     data-client_id="<?php echo $admin_google_client_id; ?>"
     data-context="signin"
     data-ux_mode="popup"
     data-callback="onSignIn"
     data-auto_prompt="false">
</div>


<!-- <meta name="google-signin-client_id" content="<?php //echo $admin_google_client_id; ?>"> -------------- old way -->
<!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -------------- old way -->
<script>
    /**
     * Handler for the signin callback triggered after the user selects an account.
     */
    function onSignInCallback(resp) {
        gapi.client.load('plus', 'v1', apiClientLoaded);
    }

    /**
     * Sets up an API call after the Google API client loads.
     */
    function apiClientLoaded() {
        gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
    }

    /**
     * Response callback for when the API client receives a response.
     *
     * @param resp The API response object with the user email and profile information.
     */
    function handleEmailResponse(resp) {
        var primaryEmail;
        for (var i=0; i < resp.emails.length; i++) {
            if (resp.emails[i].type === 'account') primaryEmail = resp.emails[i].value;
        }

        $.ajax({
            type: 'POST',
            url: 'google_login.php',
            cache: false,
            data: {gp_details: resp},
            success: function (response) {
            if(response=='1'){
                signOut();
                window.location.reload("dashboard.php");
            }else{
                signOut();
                window.location.reload("dashboard.php");
            }


        }
        });
//        document.getElementById('responseContainer').value = 'Primary email: ' +
//            primaryEmail + '\n\nFull Response:\n' + JSON.stringify(resp);
    }


    function onSignIn(response) {
        var profile = parseJwt(response.credential);
        
        console.log('complete response: ' + JSON.stringify(profile))
        console.log('ID: ' + profile.sub); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.name);
        console.log('Image URL: ' + profile.picture);
        console.log('Email: ' + profile.email); // This is null if the 'email' scope is not present.

        $.ajax({
            type: 'POST',
            url: 'google_login.php',
            cache: false,
            data: {gp_details: profile.sub,name:profile.name,email:profile.email},
            success: function (response) {
                //alert(response);
            if(response=='1'){
               // signOut();
                window.location.reload("dashboard.php");
                exit();
            }else{
              //  signOut();
                window.location.reload("dashboard.php");
                exit();
            }


        }
        });

    }
    function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};
</script>
<script>
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
        });

    }
</script>