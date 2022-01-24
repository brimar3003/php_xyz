<?php include("header.php"); ?>

<?php
  require_once("../db/db.php");

  $dataPoints=array();

  $query="SELECT MONTH(fecha) as mes, SUM(total) as total FROM ventas GROUP by MONTH(fecha)";
  $sql=db::getCon()->prepare($query);
  $sql->execute();
  while($row = $sql->fetch()){
    array_push($dataPoints,array("x"=>$row["mes"], "y"=>$row["total"]));
  }

?>

  <script>
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
    	animationEnabled: true,
    	exportEnabled: true,
    	theme: "light2",
    	title:{
    		text: "Ventas anuales"
    	},
    	data: [{
    		type: "column",
    		indexLabelFontColor: "#5A5757",
    		indexLabelPlacement: "outside",
    		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    chart.render();

    }
  </script>
  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <script>
      var menu=document.getElementById("estadisticas");
      menu.className="active";
  </script>

<?php include("footer.php"); ?>
