function chkEmail(event) {
  var new_useremail = event.currentTarget;
  var pos = new_useremail.value.search(/^[\w.-]+@([\w]+\.){1,3}[\w]{2,3}$/);

  if (pos != 0) {
    alert("The email you entered (" + new_useremail.value + 
          ") is not in the correct form.");
	
    new_useremail.focus();
    new_useremail.select();
	document.getElementById("new-useremail").value = "";
	return false;
  } 
}


function chkPwd(event) {
  var new_password = event.currentTarget;
  var len = new_password.value.length;
  var pos = new_password.value.search(/^\d*$/);
  if((pos != 0) || (len != 9)){
      alert("The password you entered (" + new_password.value + 
      ") is not in the correct form. It should be 9 pure digits.");
  new_password.focus();
  new_password.select();
  document.getElementById("new-password").value = "";
  return false;
  }

}