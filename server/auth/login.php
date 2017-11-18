<?php
include_once('../headers.php');

if (!empty($_POST)) {
    $db = new DBHelper();
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_exists = $db->getByUsername('users', $username);

    if ($user_exists) {
        if (password_verify($password, $user_exists['password'])) {
            unset($user_exists['password']);

            http_response_code(200);
            echo json_encode(['user' => $user_exists, 'type' => 'user-login-success', 'message' => 'User credentials valid. User logged in.']);
        }
        else {
            http_response_code(401);
            echo json_encode(['type' => 'password-incorrect-error', 'message' => 'The supplied password is incorrect.']);
        }
    }
    else {
        http_response_code(404);
        echo json_encode(['type' => 'username-incorrect-error', 'message' => 'That username does not exist.']);
    }
}