//javascript validation for user_registrtion
/*function validform()
{
	var first_name = document.getElementbyId('first_name').value;
	alert(first_name);
}*/
	function validateForm() 
	{
		alert("infun");
    	var first_name = document.forms["myform"]["first_name"].value;
    	if (first_name == null || first_name == "")
    	{
	        alert("Name must be filled out");
	        first_name.focus();
	        return false;
    	}
	}