<?php
session_start();

$_SESSION['message']='';
// Include config file
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'amit');
define('DB_NAME', 'virtusa');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
        $id=(int)$_SESSION['id'];

          // $id=$;
        $sql = "SELECT id, count FROM search WHERE id = $id";
        $sql1 = "SELECT id,price,state,cusine,rating,type,name,updateprice,city FROM bussines WHERE id =$id;";
        $result = $link->query($sql); 
        $row=$result->fetch_assoc();
        $res=$link->query($sql1);
        $rows=$res->fetch_assoc();
        $count=1;
                //echo sizeof($row);
                if(sizeof($row) >= 1){

                    $count=$row["count"]+1;       
                    $sql3="DELETE FROM search WHERE id=$id";
                    $link->query($sql3);
                    $sql2 = "INSERT INTO search (id, type, name, count) VALUES (?, ?, ?, ?)";
                if($stmt1 = mysqli_prepare($link, $sql2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "ssss", $param_id, $param_type,$param_name, $param_count);
            // Set parameters
            $param_id = $id;
            $param_type=$rows["type"];
            $param_name=$rows["name"];
            $param_count=$count;
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);
             }
             $chang=$rows["updateprice"]-$rows["price"];
             $tu=3;
             if($chang>77){
                $tu=0;
             }
               if($count%3==0)
               {
                $price=$rows["updateprice"]+$tu;
                 $sql8="UPDATE bussines SET updateprice=$price WHERE id=$id";
                 $link->query($sql8);
               }
                      
                } else{
                        
                $sql2 = "INSERT INTO search (id, type, name, count) VALUES (?, ?, ?, ?)";
                if($stmt1 = mysqli_prepare($link, $sql2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "ssss", $param_id, $param_type,$param_name, $param_count);
            
            // Set parameters
            $param_id = $id;
            $param_type=$rows["type"];
            $param_name=$rows["name"];
            $param_count=1;
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);
             }

        }
        // echo "amam";
    
          $sql4 = "INSERT INTO allcount (id,counts) VALUES (?, ?)";
                if($stmt1 = mysqli_prepare($link, $sql4)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "ss", $param_id, $param_count);
            
            // Set parameters
            $param_id = $id;
            $param_count=$count;
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt1);
                    mysqli_stmt_close($stmt1);
            }
        $sql6="SELECT id,type,name,count from search where id<>$id";
        $res2=$link->query($sql6);
            while($row=$res2->fetch_assoc())
            {
                $id=$row["id"];
                $count=$row["count"]; 
                if($count>0){      
                    $sql3="DELETE FROM search WHERE id=$id";
                    $link->query($sql3);
                    $sql2 = "INSERT INTO search (id, type, name, count) VALUES (?, ?, ?, ?)";
                if($stmt1 = mysqli_prepare($link, $sql2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "ssss", $param_id, $param_type,$param_name, $param_count);
            
            // Set parameters
            $param_id = $id;
            $param_type=$row["type"];
            $param_name=$row["name"];
            $param_count=$count-1;
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);
            $chang=$rows["updateprice"]-$rows["price"];
            $k=2;
            if($chang<-30){
                $k=0;
            }
               if($count%2==0)
               {
                $price=$rows["updateprice"]-$k;
                 $sql8="UPDATE bussines SET updateprice=$price WHERE id=$id";
                 $link->query($sql8);

               }

            }
           }
        }

        $id=$_SESSION["id"];

        $sql5="Select counts,times from allcount where id=$id;";
        
        $res=$link->query($sql5);
        $val=array();
        $times=array();
        while($allrow=$res->fetch_assoc()){
                array_push($val,$allrow["counts"]);
                array_push($times,$allrow["times"]);
        }
        $val=json_encode($val);
        $times=json_encode($times);
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
        <link type="text/css" href="/assets/css/docs.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,800" rel="stylesheet">
        <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
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
                text-align: left;
                margin:0;
            }
            @media only screen and (min-width: 600px) {
            .iot{
                margin-top:250px;
                }
                .chartcontrol{
                height:500px;
            }
            }
            @media only screen and (max-width: 600px){
            .locationse{
                width:300px;
                color:#2f2f2f;
                }
            .chartcontrol{
                height: 100%;
            }
            }
            .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff; 
                border-bottom: 1px solid #d4d4d4; 
            }
            .datas{
                text-align: left;
            }
            .iobar{
                margin-top:12px;
            }
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
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
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-12 iot">
                      <div class="row row-grid">
                        <div class="col-lg-12">
                          <div class="card card-lift--hover shadow border-0">
                            <div class="card-body py-5">
                              <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                <i class="ni ni-istanbul"></i>
                              </div class="datas">
                              <h3 class="text-primary text-uppercase" style="font-family:Poppins;font-weight:500;"><?php echo $rows['name']?></h3>
                                <div>
                                    <span class="badge badge-pill badge-primary iobar" style="font-family:Poppins;font-weight: 500;font-size: 14px;"><i class="fas fa-map-marker-alt"></i> <?php echo $rows['state']?></span>
                                    <br>
                                    <span class="badge badge-pill badge-primary iobar" style="font-family:Poppins;font-weight: 500;font-size: 14px;"><i class="fas fa-utensils"></i>&nbsp;&nbsp;<?php echo $rows['cusine']?></span>
                                    <br>
                                    <span class="badge badge-pill badge-primary iobar" style="font-family:Poppins;font-weight: 500;font-size: 14px;"><i class="ni ni-like-2"></i>&nbsp;&nbsp;<?php echo $rows['rating']?></span>
                                    <br>
                                    <span class="badge badge-pill badge-primary iobar" style="font-family:Poppins;font-weight: 500;font-size: 14px;"><i class="fas fa-inr" aria-hidden="true"></i> <?php echo $rows['updateprice']?></span>
                                </div>
                              <div class="datacontrol">
                                    <p style="margin-top:14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                              </div>
                              <h3>Data Insights</h3>
                              <div class="chartcontrol">
                                  <canvas id="myChart" ></canvas>
                             </div>
                            </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


<script type="text/javascript">
var plot_x = <?php echo json_encode($val); ?>;
var plot_y=<?php echo json_encode($times); ?>;
var myD=new Array();
var b = plot_x.split(',').map(function(item) {
    return parseInt(item.split('"')[1]);
});
var s = plot_y.split(',').map(function(item) {
        let p="'"+item.split('"')[1]+"'";
   //     console.log(p);
        let op=p.slice(6,8)+" Mon ";
        let res=op+p.slice(11,17);
        return res;
});


</script>
<script>
var ctx = document.getElementById('myChart');
Chart.defaults.global.defaultFontSize = 14;
Chart.defaults.global.defaultFontFamily='Poppins';
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: s,
        datasets: [{
            label: 'Trend of Searches',
            data: b,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive:true,
        maintainaspectratio:false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontSize:50,
            }
        }
    }
    }
});
</script>
<?php  
    mysqli_close($link);?>
</body>
</html>
