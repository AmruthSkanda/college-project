<?php require_once("../include/functions/session.php"); ?>
<?php
    require_once("../include/functions/functions.php");
    connect_db();
    check_connect();
    if(empty($_GET["from_id"]) || empty($_GET["to_id"]) ){
        redirect_to("index.php");
    }
    $from_id = $_GET["from_id"];
    $to_id = $_GET["to_id"];

    if(empty($_GET["date"]) ){


        $date = "%"  ;

    } else {

        $date = mysql_prep($_GET["date"]) . " " ;
    
    }

    if(empty($_GET["date"]) || empty($_GET["time"]) ){
        
        $date .=  "%" ;

    } else {

        $date .= mysql_prep($_GET["time"]) . mysql_prep(":00") ;
    }


?>

<?php include("../include/layout/header.php"); ?>

<table class="result_table" style="width:100%">
<tbody><tr>
    <th>Bus name</th>
    <th>Bus Type
    <th>Depart</th>
    <th>Arrive</th>      
    <th>Price</th>
    <th>Via</th>
</tr>



<?php 

    $query  = "select * ";
    $query .= "from bus ";
    $query .= "where startpid = {$from_id} and destpid = {$to_id} and time like '{$date}' ";
    $query .= "order by bname ASC ";
    $genre  = mysqli_query($connection, $query);



    while ( $item = mysqli_fetch_assoc($genre) ) {
        echo "<tr>";

        echo "<td>{$item["bname"]}</td>";
        echo "<td>{$item["btype"]}</td>";
        echo "<td>{$item["time"]}</td>";     
        echo "<td> </td>";
        echo "<td>{$item["price"]} </td>";

        $viaq  = "select * ";
        $viaq .= "from route ";
        $viaq .= "where rid = {$item["viaid"]}";
        $via   = mysqli_query($connection, $viaq);

        $viai = mysqli_fetch_assoc($via);
        echo "<td>{$viai["rname"]} </td>";

        echo "</tr>";

    }

?>



</tbody></table>

<?php include("../include/layout/footer.php"); ?>