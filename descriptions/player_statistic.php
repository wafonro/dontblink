<?php 
include_once("../classes/Database.php");
include_once("../classes/User.php");
include_once("../classes/Data.php");

session_name("gaming-session");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
$dbh = Database::connect();
if(isset($_SESSION['user']))
    $user = $_SESSION["user"];
else
    header("Location: ../forms/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistic</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type ="text/css" href="../css/game_description.css">
    <script src="../js/jQuery.js"></script>
    <script type="text/javascript" src="../js/jqplot/jquery.jqplot.js"></script>
    <script type="text/javascript" src="../js/jqplot/plugins/jqplot.json2.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery.jqplot.css" />
</head>
<body>
    
    <div id="chart1_1" style="height:400px;width:400px; "></div>
    <?php $allData = Data::getDatabyType($dbh,$user->nickname,1);
    // print_r(Data::getDatabyTypeandSubType($dbh,$user->nickname,1,4));
    ?>
    <script>
            $(document).ready(function(){
    // Our data renderer function, returns an array of the form:
    // [[[x1, sin(x1)], [x2, sin(x2)], ...]]
    var chart1_1Renderer = function() {
        var data = [[]];
        <?php
        $aux = count($allData);
        // picks the last ten points
        for ($i = count($allData)-1; $i >= $aux-10 && $i > 0; $i-=1) {
            echo "data[0].push([$i-$aux+10,".($allData[$i]->score/60)."]);";
        }
        ?>
        return data;
    };
    
    // we have an empty data array here, but use the "dataRenderer"
    // option to tell the plot to get data from our renderer.
    var plot1 = $.jqplot('chart1_1',[],{
        title: 'Squared 4x4',
        dataRenderer: chart1_1Renderer
    });
    });

    </script>
</body>
</html>