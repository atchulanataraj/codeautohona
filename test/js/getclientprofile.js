(function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client:plusone.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
function signinCallback(authResult) {
if (authResult['status']['signed_in']) {
    document.getElementById('signinButton').setAttribute('style', 'display: none');
	gapi.client.load('plus','v1',function(){
	gapi.client.plus.people.get({
	'userId':'me'
	}).execute(function(result){
	//document.getElementById('profile').innerHTML=JSON.stringify(result,null,2);
            console.log(result);
	$(".social_login").hide();
	$(".user_register").show();
	$(".header_title").text('Register');
         //alert(result.name.familyName);
        window.location.userid = result.id;
        $("#regFirstName").val(result.name.familyName);
        $("#regLastName").val(result.name.givenName);
	});
	});
  } else {
    console.log('Sign-in state: ' + authResult['error']);
  }
}

