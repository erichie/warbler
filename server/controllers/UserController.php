<?php
include_once('../headers.php');

// simulate GET endpoints
if (!empty($_GET)) {
    $db = new DBHelper();

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $user = $db->getById('users', $user_id);
        
        if ($user) {
            $warbles = [];
            $user_warbles = $db->getWarblesByUserId($user['id']);
            foreach ($user_warbles as $user_warble) {
                $user_warble['user'] = $user;
                $warbles[] = $user_warble;
            }
            unset($user['password']);
            http_response_code(200);
            echo json_encode(['user' => $user, 'warbles' => $warbles]);
        }
    }
}

if (!empty($_POST)) {
    $db = new DBHelper();

    $user_id = $_POST['user_id'];
    $display_name = $_POST['display_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $user = $db->getById('users', $user_id);
    $id = $user['id'];
    unset($user['id']);

    $user['display_name'] = $display_name;
    $user['username'] = $username;
    $user['email'] = $email;

    $updated_user = $db->update('users', $id, $user);

    if ($updated_user) {
        http_response_code(200);
        echo json_encode(['type' => 'user-profile-updated-success']);
    }
    else {
        http_response_code(400);
        echo json_encode(['type' => 'user-profile-updated-error']);
    }
}