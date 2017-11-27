<?php
include_once('../headers.php');

// simulate GET endpoints
if (!empty($_GET)) {
    $db = new DBHelper();

    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $user = $db->getByUsername('users', $username);
        
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