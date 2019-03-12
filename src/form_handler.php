<?php

session_start();

if (empty($_SESSION['_csrf_token'])) {
    $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['_csrf_token'];


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text']) && isset($_POST['_csrf_token'])) {

    /* Form validation */

    $errors = [];

    if ($_POST['name'] === '') {

        $errors[] = 'Name is empty';
    }

    if ($_POST['email'] === '') {

        $errors[] = 'Email is empty';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $errors[] = 'Invalid Email';
    }

    if ($_POST['text'] === '') {

        $errors[] = 'Text is empty';
    }

    if (!hash_equals($_SESSION['_csrf_token'], $_POST['_csrf_token'])) {

        $errors[] = 'Invalid csrf token';
    }

    if (!$errors) {

        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $text = htmlspecialchars($_POST['text']);

        if (!create($db, $name, $email, $text)) {

            $errors[] = 'Failed to add data';
        }
    }
}
