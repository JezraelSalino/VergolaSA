<?php
/*--------------------------------------------------------------------------------------------
|    @desc:        pagination index.php
|    @author:      Aravind Buddha
|    @url:         http://www.techumber.com
|    @date:        12 August 2012
|    @email        aravind@techumber.com
|    @license:     Free!, to Share,copy, distribute and transmit , 
|                  but i'll be glad if i my name listed in the credits'
---------------------------------------------------------------------------------------------*/
include('config.php');    //include of db config file
include ('paginate.php'); //include of paginat page

$per_page = 30;         // number of results to show per page
$result = mysql_query("SELECT * FROM ver_chronoforms_data_suburbs_vic");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);//total pages we going to have

//-------------if page is setcheck------------------//
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will telles the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
// display pagination
$page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <style type="text/css">
.logo
{
    text-align: center;
}
.container{

}
</style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="row-fluid">
                <div class="mini-layout">
                 <?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
                    echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    // display data in table
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr><th>country code</th> <th>Country Name</th> <th>Country Name</th> <th>Country Name</th></tr></thead>";
                    // loop through results of database query, displaying them in the table 
                    for ($i = $start; $i < $end; $i++) {
                        // make sure that PHP doesn't try to show results that don't exist
                        if ($i == $total_results) {
                            break;
                        }
                      
                        // echo out the contents of each row into a table
                        echo "<tr " . $cls . ">";
                        echo '<td>' . mysql_result($result, $i, 'suburb_state_vic') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'suburb_postcode_vic') . '</td>';
						echo '<td>' . mysql_result($result, $i, 'suburb_district_vic') . '</td>';
						echo '<td>' . mysql_result($result, $i, 'suburb_vic') . '</td>';
                        echo "</tr>";
                    }       
                    // close table>
                echo "</table>";
            // pagination
            ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>



