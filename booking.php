<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<?php
require_once("connection.php");
$conn = Connect();

$car_id = isset($_GET['car_id']) ? intval($_GET['car_id']) : 0;

if ($car_id === 0) {
    echo "<p style='color: red;'>Invalid car ID.</p>";
    exit;
}
?>

<title>Book Vehicle </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Vehicle Rentals </a>
            </div>
            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Vehicle</a></li>
              <li> <a href="clientview.php">View</a></li>
              <li> <a href="feedback\admin\mainpage.php">Feedback</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
              <li> <a href="feedback\index.php">Feedback</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Owner</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="contactus.php"> Contact Us </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
        </div>
    </nav>
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <br>

        <?php
        // $car_id is already defined at the top, do not overwrite it
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $car_name = $row1["car_name"];
                $car_nameplate = $row1["car_nameplate"];
                $ac_price = $row1["ac_price"];
                $non_ac_price = $row1["non_ac_price"];
                $ac_price_per_day = $row1["ac_price_per_day"];
                $non_ac_price_per_day = $row1["non_ac_price_per_day"];
            }
        }

        ?>
              <h5> Selected Vehicle:&nbsp;  <b><?php echo($car_name);?></b></h5>
            <h5> Number Plate:&nbsp;<b> <?php echo($car_nameplate);?></b></h5>
        <?php $today = date("Y-m-d") ?>
          <label><h5>Start Date:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp; 
          <label><h5>End Date:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        <h5> Choose your car type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar"> <b>With AC </b>&nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="non_ac" ng-model="myVar"><b>With-Out AC </b>
                
        
        <div ng-switch="myVar"> 
        <div ng-switch-default>
                <h5>Fare: <h5>
                     </div>
                    <div ng-switch-when="ac">
                <h5>Fare: <b><?php echo("Rs. " . $ac_price . "/km and Rs. " . $ac_price_per_day . "/day");?></b><h5>
                     </div>
                     <div ng-switch-when="non_ac">
                <h5>Fare: <b><?php echo("Rs. " . $non_ac_price . "/km and Rs. " . $non_ac_price_per_day . "/day");?></b><h5>
                     </div>
        </div>

         <h5> Charge type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="km"><b> per KM</b> &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="days"><b> per day</b>

            <br><br>
                </div>
                <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                
         
           <input type="submit"name="submit" value="Rent Now" class="btn btn-warning pull-right">     
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Note:</strong> You will be charged with extra <span class="text-danger">Rs. 500</span> for each day after the due date ends.</h6>
        </div>
    </div>
    <h3>User Reviews</h3>

<?php
$review_sql = "SELECT * FROM reviews WHERE car_id = $car_id ORDER BY review_date DESC";
$review_result = mysqli_query($conn, $review_sql);

if (!$review_result) {
    echo "<p style='color: red;'>Error fetching reviews: " . mysqli_error($conn) . "</p>";
} elseif (mysqli_num_rows($review_result) > 0) {
    while ($review = mysqli_fetch_assoc($review_result)) {
        echo '<div style="border:1px solid #ddd; padding:10px; margin-bottom:10px;">';
        echo '<strong>' . htmlspecialchars($review['username']) . '</strong> ';
        echo '<span style="color: gold;">' . str_repeat('★', $review['rating']) . '</span>';
        echo '<p>' . htmlspecialchars($review['comment']) . '</p>';
        echo '<small>Reviewed on ' . $review['review_date'] . '</small>';
        echo '</div>';
    }
} else {
    echo "<p>No reviews yet. Be the first to review!</p>";
}
?>




</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Vehicle Rentals</h5>
                </div>
            </div>
        </div>
    </footer>
</html>