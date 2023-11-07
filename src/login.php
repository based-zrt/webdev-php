<?php
require 'passwords.php';
require 'database.php';
require 'utils.php';

if (!is_post_request()) {
    json_response('Bad request');
}

if (!array_key_exists('username', $_POST) || !array_key_exists('password', $_POST)) {
    json_response('Missing field');
}
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$users = get_users();
if (!array_key_exists($username, $users)) {
    $_SESSION['login'] = false;
    redirect('/index.php');
}

if (!hash_equals($users[$username], $password)) {
    $_SESSION['login'] = false;
    $_SESSION['goToJail'] = true;
    redirect('/index.php');
}

$color = to_hex(get_user_color($username));

$_SESSION['login'] = true;
$_SESSION['color'] = $color;
redirect('/index.php');