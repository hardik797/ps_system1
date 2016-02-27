<?php
    //including required files
	include('includes/header.php');
    include('includes/session.php');

?>
    <!--Displaying all the errors here -->
    <script src="js/user.js"></script>
    <span><?php echo $er; ?></span><br>

	<form method="post" name="myform" action="controllers/attendance.php" >
		
        <div>
            <label>Select User:- </label> <br>		
            <?php
                //retriving data from database
                $sql="select id,name from users order by name ";
                $rows=fetch_data($sql);
            ?>
    		<select name="user_id" id="user_id">            
                <option value="">-SELECT-</option>
                <?php
                    foreach ($rows as $row)
                    {
                        echo '<option ' . ((isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['id']) ? 'selected="selected"': '') . ' value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                ?>
            </select> 
        </div>
        
        <!---------------------- DateTime Picker ---------------------->
        <div>
            <label>Start DateTime :-</label><br>
            <input class="startDateTime1" data-field="datetime" data-startend="start" data-startendelem=".endDateTime1" readonly name="entry_datetime" id="entry_datetime" type="text" > <br><br>
            
            <label>End DateTime :-</label><br>
            <input class="endDateTime1" data-field="datetime" data-startend="end" data-startendelem=".startDateTime1" readonly name="exit_datetime" id="exit_datetime" type="text" ><br>
            <!---------------------- Generating DateTimes ---------------------->
            <div id="dtBox"></div>
        </div>
        <div>
            <input type="submit" name="save" value="Save" onclick="return validate()" /><br>
            <input type="button" value="Check Reports" onclick="window.location.href='reports.php';" >
        </div>
	</form>	
<?php	
    //including footers files
    include('includes/footer.php');
?>
