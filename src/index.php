<?php
session_start();
if (isset($_SESSION['goToJail']) && $_SESSION['goToJail']) {
    header('refresh:3; url=https://police.hu');
    // let the user try again after coming back
    session_destroy();
}

$color = '';
if (isset($_SESSION['color'])) {
    $color = ' background-color: ' . $_SESSION['color'] . ';';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webdev PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="height: 100vh;<?= $color ?>" class="w-100 container d-flex flex-column justify-content-center">
    <h1>Webdev PHP Exercise</h1>
    <form class="w-50 p-3 rounded" style="background-color: #ffffff;" action="login.php" method="post">
        <?php
        if (key_exists('login', $_SESSION)) {
            if ($_SESSION['login']) {
                echo('<div class="alert alert-success" role="alert">Login successful!</div>');
            } else {
                echo('
                <div class="alert alert-danger" role="alert">
                <p>Invalid credentials!</p>
                <a href="https://www.quora.com/Why-do-most-websites-say-Incorrect-username-or-password-instead-of-whichever-is-wrong">Why don\'t I show invalid password messages separately?</a>
                </div>'
                );
            }
        }

        if (!isset($_SESSION['color'])) {
            echo('
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit
            </form>
            ');
        } else {
            echo('
            </form>
            <a href="reset.php"><button class="btn btn-secondary">Reset</button></a>
            ');
        }
        ?>
</body>
</html>


