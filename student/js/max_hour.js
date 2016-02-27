function validate()
{
    var entry = document.getElementById('entry_datetime').value;
    var exit = document.getElementById('exit_datetime').value;
    if (document.getElementById('user_id').value == "")
    {
        alert("Please select user from the list");
        document.getElementById('user_id').focus(); 
        return false;     
    }        
    if (document.getElementById('type').value == "")
    {
        alert("Please select type from the list");
        document.getElementById('type').focus(); 
        return false;     
    }        
    if (entry > exit)
    {
        alert("entry time not greater then exit time");
        document.getElementById('entry_datetime').focus();
        return false;
    }        
    else
    {
        return true;
    }

}
