<?php 
include ('../management/include/functions.php');
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
$user = new Admin();

if (!$user->get_session())
{
	header("location:login.php");
}


if($_REQUEST['getmeout'] == 'ok')
{
	$user->logout();
}

?>
<!DOCTYPE html>
<html>
<head>
<link href="css/extension-page-style.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<style>
.code-block-holder pre {
      max-height: 188px;  
      min-height: 188px; 
      overflow: auto;
      border: 1px solid #ccc;
      border-radius: 5px;
}
.tab-btn-holder {
	width: 100%;
	margin: 20px 0 0;
	border-bottom: 1px solid #dfe3e4;
	min-height: 30px;
}
.tab-btn-holder a {
	background-color: #fff;
	font-size: 14px;
	text-transform: uppercase;
	color: #006bb8;
	text-decoration: none;
	display: inline-block;
	*zoom:1; *display:inline;


}
.tab-btn-holder a.active {
	color: #858585;
    padding: 9px 10px 8px;
    border: 1px solid #dfe3e4;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    position: relative;
    z-index: 300;
}
#ex1 text
{
	display:none;
}
</style>

</head>
<body>
<!-- Admin Main Area -->

<?php

/**
* This example describes the single seriese chart preparation using FusionCharts PHP wrapper
*/


// Including the wrapper file in the page
include("src/fusioncharts.php");


	// Preparing the object of FusionCharts with needed informations
    /**
    * The parameters of the constructor are as follows
    * chartType   {String}  The type of chart that you intend to plot. e.g. Column3D, Column2D, Pie2D etc.
    * chartId     {String}  Id for the chart, using which it will be recognized in the HTML page. Each chart on the page should have a unique Id.
    * chartWidth  {String}  Intended width for the chart (in pixels). e.g. 400
    * chartHeight {String}  Intended height for the chart (in pixels). e.g. 300
    * containerId {String}  The id of the chart container. e.g. chart-1
    * dataFormat  {String}  Type of data used to render the chart. e.g. json, jsonurl, xml, xmlurl
    * dataSource  {String}  Actual data for the chart. e.g. {"chart":{},"data":[{"label":"Jan","value":"420000"}]}
    */
$columnChart = new FusionCharts("column2d", "ex1" , "100%", 400, "chart-1", "json", '{
      "chart": {
        "caption": "Harry\'s SuperMart - Top 5 Stores\' Revenue",
        "subCaption": "Last Quarter",
        "numberPrefix": "$",
        "rotatevalues": "0",
        "plotToolText": "<div><b>$label</b><br/>Sales : <b>$$value</b></div>",
        "theme": "fint"
      },
      "data": [{
        "label": "Bakersfield Central",
        "value": "880000"
      }, {
        "label": "Garden Groove harbour",
        "value": "730000"
      }, {
        "label": "Los Angeles Topanga",
        "value": "590000"
      }, {
        "label": "Compton-Rancho Dom",
        "value": "520000"
      }, {
        "label": "Daly City Serramonte",
        "value": "330000"
      }, {
        "label": "Garden Groove harbour",
        "value": "730000"
      }, {
        "label": "Los Angeles Topanga",
        "value": "590000"
      }, {
        "label": "Compton-Rancho Dom",
        "value": "520000"
      }, {
        "label": "Daly City Serramonte",
        "value": "330000"
      }
	  
	  ]
    }');
// Render the chart
$columnChart->render();
?>
<div id="chart-1"><!-- Fusion Charts will render here--></div>
 

</body>
</html>