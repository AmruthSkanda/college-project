<?php require_once("../include/functions/session.php"); ?>
<?php
    require_once("../include/functions/functions.php");
    connect_db();
    check_connect();

?>
<?php include("../include/layout/header.php"); ?>


<form action="result.php" method="get">
    
<div id="search">
    <div id="s_left">
        <label id="s_lable">From</label>
        <br />

        <?php 

            $sql = "SELECT * FROM place "; 
            $place   = mysqli_query($connection, $sql);

            echo "<select name='from_id' > </option>";
            echo "<option value=''>none</option>"; 
            while ( $iplace = mysqli_fetch_assoc($place) ) {
                echo "<option value={$iplace['plid']}>{$iplace['plname']}</option>"; 
            }
            echo "</select>";// Closing of list box

        ?>

<!--   <input id="from" type="text" placeholder="" name="from" value="" /> -->
        <br />
        <label id="s_lable">Date</label>
                <br />
        <input type="text" name="date" value="" id="popupDatepicker">     
        <br />
    </div>
    <div id="s_right">
        <label id="s_lable">To</label>
                <br />

        <?php 

            $sql = "SELECT * FROM place "; 
            $place   = mysqli_query($connection, $sql);

            echo "<select name='to_id' > </option>";
            echo "<option value=''>none</option>"; 
            while ( $iplace = mysqli_fetch_assoc($place) ) {
                echo "<option value={$iplace['plid']}>{$iplace['plname']}</option>"; 
            }
            echo "</select>";// Closing of list box

        ?>
        
        <!-- <input id="to" type="text" placeholder="" name="to" value="" /> -->
        <br />
        <label id="s_lable">Time</label>
                <br />
        <input type="text" name="time" value="" id="inputTimepicker">

    </div>
    
    <input type="submit" id="sub" name="submit" value="Search">
</div>
</form>
<?php include("../include/layout/footer.php"); ?>