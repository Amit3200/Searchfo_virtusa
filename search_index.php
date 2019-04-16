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
 
// Define variables and initialize with empty values
$city=$city_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["city"]))){
        $city_err = 'Please enter city.';
        $_SESSION['message'] = $city_err;
    } else{
        $city = trim($_POST["city"]);
    }
    
    
    // Validate credentials
    if(empty($city_err)){
        // Prepare a select statement
        $sql = "SELECT name, city, state FROM bussines WHERE city = '$city';";
        
           if($link->query($sql)==true){
            $_SESSION['city']=$city;
            header("location: index_food.php");
       }
        else
        {
           $city_err="Oops!. No city with this name.";
           $_SESSION['message'] = $city_err;
        }
    }
    else
    {
        $city_err="Please enter City.";
        $_SESSION['message'] = $city_err;
    }
    
    mysqli_close($link);
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
            }
            @media only screen and (max-width: 600px){
            .locationse{
                width:300px;
                color:#2f2f2f;
                }
            }
            .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff; 
                border-bottom: 1px solid #d4d4d4; 
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
                                <i class="ni ni-check-bold"></i>
                              </div>
                              <h1 class="text-primary text-uppercase" style="font-family:Poppins;font-weight:700;">Searchfo</h1>
                              <form autocomplete="off" method="POST">
                                <div>
                                    <input type="text" name="city" placeholder="Enter City" class="locationse form-control" maxlength="25" id="myInput" required>
                                </div>
                              <button type="submit" class="btn btn-primary mt-4">Search</button>
                            </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
                function autocomplete(inp, arr) {

                  var currentFocus;
                  inp.addEventListener("input", function(e) {
                      var a, b, i, val = this.value;
                      closeAllLists();
                      if (!val) { return false;}
                      currentFocus = -1;
                      a = document.createElement("DIV");
                      a.setAttribute("id", this.id + "autocomplete-list");
                      a.setAttribute("class", "autocomplete-items");
                      this.parentNode.appendChild(a);
                      for (i = 0; i < arr.length; i++) {
                        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                          b = document.createElement("DIV");
                          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                          b.innerHTML += arr[i].substr(val.length);
                          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                          b.addEventListener("click", function(e) {
                              inp.value = this.getElementsByTagName("input")[0].value;
                              closeAllLists();
                          });
                          a.appendChild(b);
                        }
                      }
                  });
                  inp.addEventListener("keydown", function(e) {
                      var x = document.getElementById(this.id + "autocomplete-list");
                      if (x) x = x.getElementsByTagName("div");
                      if (e.keyCode == 40) {
                        currentFocus++;
                        addActive(x);
                      } else if (e.keyCode == 38) { 
                        currentFocus--;
                        addActive(x);
                      } else if (e.keyCode == 13) {
                        e.preventDefault();
                        if (currentFocus > -1) {
                          if (x) x[currentFocus].click();
                        }
                      }
                  });
                  function addActive(x) {
                    if (!x) return false;
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    x[currentFocus].classList.add("autocomplete-active");
                  }
                  function removeActive(x) {
                    for (var i = 0; i < x.length; i++) {
                      x[i].classList.remove("autocomplete-active");
                    }
                  }
                  function closeAllLists(elmnt) {
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                      if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                      }
                    }
                  }
                  document.addEventListener("click", function (e) {
                      closeAllLists(e.target);
                  });
                }
                var cities=["Allahabad","Agra","Jalandhar","Hyderabad","Phagwara","Amritsar","Chandigarh","Delhi","Kolkata","Mumbai","Pune","Lucknow","Kanpur","Varanasi","Gurugram","Noida","Bangalore","Chennai"];                
                autocomplete(document.getElementById("myInput"), cities);
                </script>
</body>
</html>
