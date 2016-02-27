<?php
    //including required files
	include('includes/header.php');
    include('includes/session.php');

?>
<script src="js/report.js"></script>
    <!--Displaying all the errors here -->
    <span><?php echo $er; ?></span><br>

	<form method="post" action="controllers/generate_reports.php" >
		
        <div>
            <label>Select User :-</label><br>

                <?php
                    //retriving data from database
                    $sql="select id, name from users order by name ";
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

        <div>

            <label>Select Report Types :-</label><br>

            <select name="type" id="type" >            
                <option value="">-SELECT-</option>
                <option value="new">Newset</option>
                <option value="old">Oldest</option>
                <option value="all">All</option>
            </select> 

        </div>

        <div>
            <input type="submit" name="check" value="Check" onclick="return validate()" /><br>	
            <input type="submit" name="month_report" value="Monthly Report" onclick="return validate()" style="color: #254117;" />
        </div>

    </form>	
<?php	
    //including footers files
    include('includes/footer.php');
?>
