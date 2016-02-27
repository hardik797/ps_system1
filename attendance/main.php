<?php 

    include('database.php');
    $users = get_rows("select id, name from users order by name");  
?>
<head>
<link rel = "stylesheet" type = "text/css" href = "jquery.datetimepicker.css"/ >
<script src = "jquery.js"></script>
<script src = "jquery.datetimepicker.full.min.js"></script>
<script language = "javascript" type = "text/javascript">

    function validate()
    {

        var entry = document.myform.entry_time.value;
        var exit = document.myform.exit_time.value;

        if(document.myform.user_id.value == "")
        {
            alert("plz Select User First");
            document.getElementById("user_id").focus();
            return false;
        }
        else if(document.myform.entry_time.value == "")
        {
            alert("Please Select Entry Date First");
            document.getElementById("entry").focus();
            return false;
        }

        else if(document.myform.exit_time.value == "")
        {
            alert("Please Select Exit Date First");
            document.getElementById("exit").focus();
            return false;
        }
        else if(exit < entry)
        {
            alert("Slect Date Properly");
            document.getElementById("entry").focus();
            return false;
        }
        else
        {
        return validate;
        }
    }

</script>
</head>
<form method = "post" name = "myform" onsubmit = "return validate()" action = "attendance.php">
    <body bgcolor="grey"><div align="center" style="margin-top:200px"><table ><tr>
        <td align="center">User:</td> 
        <td>
        <?php
        if (count($users) > 0)
        {
        ?>
            <select name = "user_id" id = "user_id">
            <?php
            echo '<option value = "">Select a user</option>';
            foreach ($users as $row)
            {
                echo '<option ' . ((isset($post_data['user_id']) && $post_data['user_id'] == $row['id']) ? 'selected="selected"': '') . ' value = "' . $row['id'] . '">' . $row['name'] . '</option>';
            }   
            ?>
            </select>
            <?php
        }
        else
        {
            echo 'Please enter data for users'; 
        }
        ?>
        </td></tr>
        <tr> <td align="center"> Status: </td>
        <td>
        <select name = "status" id = "status">
            <option>----Select Status----</option>
            <option name = "status">latest</option>
            <option name = "status">oldest</option>
            <option name = "status">all</option>
        </select>
        </td></tr>

        <tr><td >
        Entry Time:
        </td><td >
        <input id = "entry" type = "text" name = "entry_time" >
        </td></tr>
        <script >
            jQuery('#entry').datetimepicker(
                {format:'Y-m-d H:i:s'}
                );
        </script>

        <tr><td>
        Exit Time:
        </td><td>
        <input id = "exit" type = "text" name = "exit_time" >
        </td></tr>

        </table>
        <script>
            jQuery('#exit').datetimepicker(
                {format:'Y-m-d H:i:s'}
                );
        </script>

        <button name = "maximum"> Max Hours</button>
        <button name = "allhour">All Working Hours</button>
        <input type = "submit" name = "submit" value = "Find"/>
        <button name = "report">Whole Report </button>
       </div>
    </body>
</form>
       