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
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type ="text/css" href="../css/game_description.css">
    <script src="../js/jQuery.js"></script>
    <script type="text/javascript" src="../js/jqplot/jquery.jqplot.js"></script>
    <script type="text/javascript" src="../js/jqplot/plugins/jqplot.json2.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery.jqplot.css" />
</head>
<body>
<?php $allData = Data::getDatabyType($dbh,$user->nickname,1);
//min and max for each game;
$aux = [[4,10],[1,12],[1,5]];
for($game = 1; $game <= 3; $game++){
    for($subtype = $aux[$game-1][0]; $subtype <= $aux[$game-1][1]; $subtype++){
        $dataAux = Data::getDatabyTypeandSubType($dbh,$user->nickname,$game,$subtype);
        echo "
        <div id='chart".$game."_".$subtype."' style='height:400px;width:400px; '></div>
        <script>
        $(document).ready(function(){
                var chart".$game."_".$subtype."Renderer = function() {
                    var data = [[]];";
                    $aux = count($allData);
                    // picks the last ten points
                    for ($i = count($allData)-1; $i >= $aux-10 && $i > 0; $i-=1) {
                        echo "data[0].push([$i-$aux+10,".($dataAux[$i]->score)."]);";
                    }
                    echo"    return data;
                };
                var plot1 = $.jqplot('chart".$game."_".$subtype."',[],{
                    title: 'chart".$game."_".$subtype."Renderer',
                    dataRenderer: chart".$game."_".$subtype."Renderer
                });
                
            });
        </script>";
    }
}
        ?>

</body>
</html>