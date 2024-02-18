<?php

@include 'config.php';

session_start();

$pune = 18000;
$mum = 25000;
$banglore = 30000;
$nashik = 15000;
$chennai = 22000;
$delhi = 21000;
$insur = 500;
$sip_amt = 0.15 * $_SESSION['sal'];
$loc = strtolower($_SESSION['location']);

if ($_SESSION['sal'] * 12 <= 250000) {
    $tax = 0;
} elseif ($_SESSION['sal'] * 12 > 250000 && $_SESSION['sal'] * 12 <= 500000) {
    $tax = ($_SESSION['sal'] * 12 - 250000) * 0.15;
} elseif ($_SESSION['sal'] * 12 > 500000 && $_SESSION['sal'] * 12 <= 1500000) {
    $tax = (500000 - 250000) * 0.15 + ($_SESSION['sal'] * 12 - 500000) * 0.25;
} else {
    $tax = (500000 - 250000) * 0.15 + (1500000 - 500000) * 0.25 + ($_SESSION['sal'] * 12 - 1500000) * 0.3;
}


if ($loc == 'pune') {
    $col = $pune;
} else if ($loc == 'mumbai') {
    $col = $mum;
} else if ($loc == 'banglore') {
    $col = $banglore;
} else if ($loc == 'chennai') {
    $col = $chennai;
} else if ($loc == 'delhi') {
    $col = $delhi;
} else if ($loc == 'nashik') {
    $col = $nashik;
} else {
    $col = 17000;
}

$tme=$col + $insur + $sip_amt;

if (!isset($_SESSION['email'])) {
    header('location:login_form.php');
    exit; // Added exit after redirection
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Expenses</title>
    <link rel="stylesheet" href="css/expense.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container" style="margin-botton:20vh;">

        <div class="expense">
            <h3>Hello, <span>
                    <?php echo $_SESSION['email'] ?>
                </span></h3>
            <h2>Your Stats:</h2>
          
    </div>


        <div class="container" style="margin-left:22vw;">

            <div class="row row-expense">
                <div class="col-4">Salary</div>
                <div class="col-4"><?php echo $_SESSION['sal'] ?></div>
                <!-- <div class="col-4">.col-4</div> -->
            </div>
            <div class="row row-expense">
                <div class="col-4">Salary after taxation</div>
                <div class="col-4"><?php echo (int)($_SESSION['sal'] - ($tax / 12)) ?></div>
                <!-- <div class="col-4">.col-4</div> -->
            </div>

            <div class="row row-expense">
                <div class="col-sm-4"> Residential area</div>
                <div class="col-sm-4"><?php echo $loc ?></div>
                <!-- <div class="col-sm-4">.col-sm-4</div> -->
            </div>

            <div class="row row-expense">
                <div class="col-md-4">Cost of living + Rent in <?php echo $loc ?></div>
                <div class="col-md-4"><?php echo $col ?></div>
                <!-- <div class="col-md-4">.col-md-4</div> -->
            </div>

            <div class="row row-expense">
                <div class="col-lg-4">Your loan EMI</div>
                <div class="col-lg-4"><?php echo $_SESSION['emi'] ?></div>
                <!-- <div class="col-lg-4">.col-lg-4</div> -->
            </div>

            <div class="row row-expense">
                <div class="col-xl-4">Insurance Amount</div>
                <div class="col-xl-4"><?php echo $insur ?></div>
                <!-- <div class="col-xl-4">.col-xl-4</div> -->
            </div>
            <div class="row row-expense">
                <div class="col-xl-4">SIP Amount</div>
                <div class="col-xl-4"><?php echo $sip_amt ?></div>
                <!-- <div class="col-xl-4">.col-xl-4</div> -->
            </div>
            <div class="row row-expense">
                <div class="col-xl-4">Goal Amount to reach</div>
                <div class="col-xl-4"><?php echo $_SESSION['ga'] ?></div>
                <!-- <div class="col-xl-4">.col-xl-4</div> -->
            </div>
            <div class="row row-expense">
                <div class="col-xl-4">Months to reach req. amt. after this SIP</div>
                <div class="col-xl-4"><?php echo (int)($_SESSION['ga']/$sip_amt) ?></div>
                <!-- <div class="col-xl-4">.col-xl-4</div> -->
            </div>
            <div class="row row-expense">
                <div class="col-xl-4">Total monthly expense</div>
                <div class="col-xl-4"><?php echo $tme ?></div>
                <!-- <div class="col-xl-4">.col-xl-4</div> -->
            </div>
            <div class="row row-expense">
                <div class="col-xl-4">Amount Left:</div>
                <div class="col-xl-4"><?php echo (int)($_SESSION['sal'] - ($tax / 12)-$tme) ?></div>
                <!-- <div class="col-xl-4">.col-xl-4</div> -->
            </div>
            

        

            

        </div> <!-- /container -->







</body>

</html>