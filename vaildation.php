<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vaildation.css">
</head>
<html>

<body>
    <?php
    $nameError = $emailError = $phoneError = "";
    $nameError = $emailError = $phoneError = "";
    $erroFlag = false;
    $name = $email = $phone = "";
    // Debug line to see if form is submitted
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        if (empty($name)) {
            $nameError = 'Name is required';
            $erroFlag = true;
        }
        if (empty($email)) {
            $emailError = 'Email is required';
            $erroFlag = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = 'Invalid email format';
            $erroFlag = true;
        }
        if (empty($phone)) {
            $phoneError = 'Phone number is required';
            $erroFlag = true;
        } else {
            $Phone_regex = "/^[1-9][0-9]{9}$/";
            if (!preg_match($Phone_regex, $phone)) {
                $phoneError = "Phone number must be ten digit with no leading zero";
                $erroFlag = true;
            }
        }
        if (!$erroFlag) {
            /* insert data into the database */
            $succ_message = "Form submitted successfully!";
            echo "<div class='alert alert-success' role='alert'>$succ_message</div>";
        }
    }

    ?>
    <div class="main">
        <form class="book" action="" method="post">
            <div class="pen">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Name" value="<?= $name ?>">
                <div class="showErro" style="color: red;"><?= $nameError ?></div>
            </div>
            <div class="pen">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter Email" value="<?= $email ?>">
                <div class="showErro" style="color: red;"> <?= $emailError ?> </div>
            </div>
            <div class="pen">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter phone number" value="<?= $phone ?>">
                <div class="showErro" style="color: red;"><?= $phoneError ?></div>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</body>

</html>