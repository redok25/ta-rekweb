<?php 

include "php-native/config.php";

if (isset($_SESSION['user'])) {
    $emparray = array();
    $result = $con->query("SELECT * from pin WHERE user_name = '".$_SESSION['user']."' ");
    while($row = mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<title>SIG Kota Yogyakarta</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/normalize.min.css" rel="stylesheet"> -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="css/template.css" rel="stylesheet">
    <link href="css/hover-min.css" rel="stylesheet">
	  <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="icon" href="image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.sticky.min.js"></script>
    

    <script>
      if (!Object.entries) {
        Object.entries = function( obj ){
          var ownProps = Object.keys( obj ),
              i = ownProps.length,
              resArray = new Array(i); // preallocate the Array
          while (i--)
            resArray[i] = [ownProps[i], obj[ownProps[i]]];
          
          return resArray;
        };
      }
    </script>

    <script type="text/javascript">
      document.onreadystatechange = function() {
          if (document.readyState !== "complete") {
              document.querySelector(".close-all").style.display = "block";
          }else {
              document.querySelector(".close-all").style.display = "none";
          }
      };
    </script>


    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mapbase.js"></script>
    <script type="text/javascript" src="js/accounting.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script type="text/javascript">
      function konfirm(text, url){
        $.confirm({
            title: 'Konfirmasi',
            icon: 'fa fa-question',
            content: text,
            theme: 'modern',
            type: 'orange',
            buttons: {
                 ya: {
                    btnClass: 'btn-warning',
                    action: function(){
                      window.location.href = url;

                    }
                },
                tidak: function () {
                },
            }
        });
      }
    </script>

</head>
<body>