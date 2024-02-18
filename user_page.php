<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
    exit; // Added exit after redirection
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $prof = mysqli_real_escape_string($conn, $_POST['prof']);
    $loan_emi = mysqli_real_escape_string($conn, $_POST['loan_emi']);
    $goal_amt = mysqli_real_escape_string($conn, $_POST['goal_amt']);

    // Corrected SQL query and added proper error handling
    $insert = "INSERT INTO money_info(salary, location, job_profile, loan_emi, goal_amt, email) VALUES('$salary','$location','$prof','$loan_emi','$goal_amt','$email')";

    if (mysqli_query($conn, $insert)) {
        $_SESSION['location'] = $location; // Assigning the goal_amt directly without using $row
        $_SESSION['ga'] = $goal_amt; // Assigning the goal_amt directly without using $row
        $_SESSION['email'] = $email; // Assigning the goal_amt directly without using $row
        $_SESSION['sal'] = $salary; // Assigning the goal_amt directly without using $row
        $_SESSION['emi'] = $loan_emi; // Assigning the goal_amt directly without using $row
        header('location:expense.php');
        exit; // Added exit after redirection
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}

// $_SESSION['user_name'] = $row['name'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user_page.css">

</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <p style="font-weight:bold;">FinLiterature</p>
        </div>
        <div class="nav-right">
            <li><a href="user_page.php" class="">Home</a></li>
            <li><a href="expense.php" class="">Expenses</a></li>
            <li><a href="" class="">About</a></li>
            <li><a href="finlit.php" class="">FinLit</a></li>
            <li><a href="calculators.php" class="">Loan Calculator</a></li>
        </div>
    </div>

    <div class="container">

        <div class="content">
            <h3>hi, <span><?php echo $_SESSION['user_name'] ?></span></h3>
            <h1>welcome to FinLiterature<span>
                    
                    <!-- <?php echo $_SESSION['user_id'] ?> -->
                </span></h1>
            <a href="login_form.php" class="btn">login</a>
            <a href="registration_form.php" class="btn">register</a>
            <a href="logout.php" class="btn">logout</a>
            <br>
            <br>
            <br>
            <small style="display: flex; justify-content: center;">Continue <img src="down_svg.svg" alt=""></small>
        </div>
    </div>
    <div class="form-container" style="padding: 40px;">

        <div class="money-img">
            <img src="money.gif" width="300px" alt="">
        </div>

        <form action="" method="post">
            <h3>Let us know the following: </h3>
            <h3 style="font-size:15px;">Used to generate your expenses</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ;
            }
            ;
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="number" name="salary" required placeholder="Enter your salary (pm)">
            <input type="text" name="location" required placeholder="Enter your location">
            <input type="text" name="prof" required placeholder="Your job profile">
            <input type="number" name="loan_emi" required placeholder="Loan EMI (use EMI calculator for same)">
            <input type="number" name="goal_amt" required placeholder="Amount you require for your next goal">
            <input type="submit" name="submit" value="Submit" class="form-btn">
            <!-- <p>already have an account? <a href="login_form.php">login now</a></p> -->
        </form>

    </div>

</body>

</html>