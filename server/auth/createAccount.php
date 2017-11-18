<?php
include_once('../headers.php');

if (!empty($_POST)) {
    $db = new DBHelper();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $display_name = $_POST['display_name'];

    $user_exists = $db->getByUsername('users', $username);
    if ($user_exists) {
        http_response_code(409);
        echo json_encode(['type' => 'username-exists-error', 'message' => 'Username already exists']);
    }
    else {
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        
        $user = [
            'username' => $username,
            'password' => $encrypted_password,
            'email' => $email,
            'display_name' => $display_name
        ];
    
        $user_id = $db->create('users', $user);
    
       if ($user_id) {
           http_response_code(200);
           echo json_encode(['user' => ['id' => $user_id, 'username' => $username, 'display_name' => $display_name], 'type' => 'user-created-success', 'message' => 'Account created successfully']);
       }
    }
}