<?php
session_start();

$_SESSION['message']='';
// Include config file
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'amit');
define('DB_NAME', 'virtusa');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
          $city=$_SESSION['city'];
    
        // Prepare a select statement
        $sql = "SELECT id, name, city, state, price,cusine,updateprice FROM bussines WHERE city = '$city';";
        
           if($link->query($sql)==true){
        $result = $link->query($sql); //$result = mysqli_result object
        //var_dump($result);
    
    }
    error_reporting(E_ERROR);
     $_SESSION['id']=0;   
     $_SESSION['id']=$_POST["detail"];
    if($_SESSION['id']!=0) {
            header("location: details_show.php");
        }
?>
<html>
    <title>Searchfo</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
        <meta name="ToughX" content="ToughX">
        <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href="assets/css/argon.css?v=1.0.1" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link type="text/css" href="assets/css/docs.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,800" rel="stylesheet">
        <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <style>
            body{
                background:#E5E6EA;
                font-style: "Poppins" !important;
                font-weight: 500;
            }
            .locationse{
                color:#2f2f2f;
                width:400px;
                font-weight:500;
                border:1px solid #c4c4c4;
            }
            .locationse:focus{
                color:#2f2f2f;
                border:2px solid #5e72e4; 
                font-weight:500;
                font-family: "Poppins";
            }
            .locationse::placeholder{
                font-weight:500;
                font-family: "Poppins";
            }
            .card-body{
                text-align: center;
                margin:0 auto;
            }
            @media only screen and (min-width: 600px) {
            .iot{
                margin-top:250px;
                }
            .triumph{
                margin-top:-220px;
            }
            }
            @media only screen and (max-width: 600px){
            .locationse{
                width:300px;
                color:#2f2f2f;
                }
            .triumph{
                margin-top:35px;
                word-wrap: break-word;
            }
            .container{
                margin: -70px 0 0 0;
            }
            .bdg{
                /*float:left;*/
                width: 300px;
                margin-top:25px;
            }
            .uiop{
                display: -webkit-flex;
                -webkit-flex-wrap:wrap;
                display: flex;
                flex-wrap:wrap;
                flex-direction: row-reverse;
            }

            }
            .badge{
                font-size: 16px;
                font-family: "Poppins";
                font-weight: 400;
            }
            .uio{
                margin-top:20px;
            }
            .icon{
                margin: 0 auto;
            }
            .card-body{
                margin: 0 0 0 0;
            }

        </style>
    </head>
<body>
        <header class="navbar navbar-expand navbar-dark flex-row align-items-md-center ct-navbar" style="background: white">
                <a class="navbar-brand mr-0 mr-md-2" href="../../docs/getting-started/index.html" aria-label="Bootstrap">
                 <h3 class="logohere" style="font-weight:500">Searchfo</h3>
                 <span style="color:black;">Virtusa Hackathon</span>
                </a>
        </header>
        <section class="section section-lg pt-lg-0 mt--200">
                <div class="container cops">

        <?php while($row=$result->fetch_assoc()){
            $change=$row["updateprice"]-$row["price"];
            $bool=0;
            if($change>0){
                $bool=1;
            }
            else{
                $bool=0;
            }
            if($bool==1){
            echo ' <form method="POST" action="index_food.php"><div class="row justify-content-center triumph">
                    <div class="col-lg-12 iot">
                      <div class="row row-grid">
                        <div class="col-lg-12">
                          <div class="card card-lift--hover shadow border-0">
                            <div class="card-body py-5">
                              <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                <i class="ni ni-istanbul"></i>
                              </div>
                              <!-- <h1 class="text-primary text-uppercase" style="font-family:Poppins;font-weight:700;">Searchfo</h1> -->
                              <!-- <p class="description mt-3"><h4>Enter Location</h4></p> -->
                              
                              <div>
                                    <table cellpadding="5px">
                                        <tr class="uio">
                                            <td style="width:80px"><h3 style="font-family:Poppins;font-weight: 500;">'.$row["name"].'</h3></td>
                                        </tr>
                                        <tr class="uio uiop">
                                            <td style="width:80px"><span class="badge badge-pill badge-primary bdg" style="font-family:Poppins;font-weight: 500;">&nbsp<i class="fas fa-utensils"></i>&nbsp;&nbsp; '.$row["cusine"].'</span></td>
                                            <td style="width:80px"><span class="badge badge-pill badge-primary bdg" style="font-family:Poppins;font-weight: 500;">&nbsp<i class="fas fa-inr" aria-hidden="true"></i>&nbsp;&nbsp;'.$row["updateprice"].'</td>
                                            <td style="width:200px"><span class="badge badge-pill badge-success bdg" style="font-family:Poppins;font-weight: 500;"><i class="ni ni-bold-up"></i>&nbsp;&nbsp; '.abs($change).'</span></td>
                                        </tr>
                                        <tr class="uio"></tr><td><button type="submit" name="detail" value='.$row["id"].' class="btn btn-primary mt-4" style="font-family:Poppins;font-weight: 500;">Details</button></td></tr>
                                    </table>
                                  </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div></form>';}
            else{
            echo ' <form method="POST" action="index_food.php"><div class="row justify-content-center triumph">
                    <div class="col-lg-12 iot">
                      <div class="row row-grid">
                        <div class="col-lg-12">
                          <div class="card card-lift--hover shadow border-0">
                            <div class="card-body py-5">
                              <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                <i class="ni ni-istanbul"></i>
                              </div>
                              <!-- <h1 class="text-primary text-uppercase" style="font-family:Poppins;font-weight:700;">Searchfo</h1> -->
                              <!-- <p class="description mt-3"><h4>Enter Location</h4></p> -->
                              
                              <div>
                                    <table cellpadding="5px">
                                        <tr class="uio">
                                            <td style="width:80px"><h3 style="font-family:Poppins;font-weight: 500;">'.$row["name"].'</h3></td>
                                        </tr>
                                        <tr class="uio uiop">
                                            <td style="width:80px"><span class="badge badge-pill badge-primary bdg" style="font-family:Poppins;font-weight: 500;">&nbsp<i class="fas fa-utensils"></i>&nbsp;&nbsp; '.$row["cusine"].'</span></td>
                                            <td style="width:80px"><span class="badge badge-pill badge-primary bdg" style="font-family:Poppins;font-weight: 500;">&nbsp<i class="fas fa-inr" aria-hidden="true"></i>&nbsp;&nbsp;'.$row["updateprice"].'</td>
                                            <td style="width:200px"><span class="badge badge-pill badge-warning bdg" style="font-family:Poppins;font-weight: 500;"><i class="ni ni-bold-down"></i>&nbsp;&nbsp; '.abs($change).'</span></td>
                                        </tr>
                                        <tr class="uio"></tr><td><button type="submit" name="detail" value='.$row["id"].' class="btn btn-primary mt-4" style="font-family:Poppins;font-weight: 500;">Details</button></td></tr>
                                    </table>
                                  </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div></form>';}}
                ?>
            </div>
        <?php mysqli_close($link); ?>
        </section>
</body>
</html>
