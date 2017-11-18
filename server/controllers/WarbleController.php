<?php
include_once('../headers.php');

if (!empty($_POST)) {
    if (isset($_POST['warble_content']) && isset($_POST['user_id'])) {
        $db = new DBHelper();

        $user_id = $_POST['user_id'];
        $warble_content = $_POST['warble_content'];
        preg_match_all('/(#)\w*/', $warble_content, $hashtags);
        $new_hashtags = [];
        
        if (isset($hashtags[0])) {
            foreach ($hashtags[0] as $hashtag) {
                $hashtag_exists = $db->hashtagExists($hashtag);
                
                if (is_null($hashtag_exists)) {
                    $hashtag_to_create = [
                        'name' => $hashtag
                    ];
                    $new_hashtag_id = $db->create('hashtags', $hashtag_to_create);
                }
                else {
                    $new_hashtag_id = $hashtag_exists['id'];
                }

                $new_hashtags[] = $new_hashtag_id;
            }
        }
        
        $warble = [
            'user_id' => $user_id,
            'content' => $db->escapeString($warble_content),
            'likes' => 0,
            'date' => Carbon\Carbon::now()
        ];

        $result = $db->create('warbles', $warble);

        if ($result) {
            if (!empty($new_hashtags)) {
                foreach ($new_hashtags as $new_hashtag) {
                    $hashtag_warble = [
                        'hashtag_id' => $new_hashtag,
                        'warble_id' => $result
                    ];

                    $new_hashtag_warble = $db->create('hashtag_warbles', $hashtag_warble);
                }
            }

            http_response_code(200);
            echo json_encode(['type' => 'warble-created-success']);
        }
    }
}
else if (!empty($_GET)) {
    if (isset($_GET['all_warbles'])) {
        $db = new DBHelper();
        $warbles = $db->getAllByDate('warbles');
        
        if ($warbles) {
            $warbles_with_user = [];

            foreach ($warbles as $warble) {
                $user = $db->getById('users', $warble['user_id']);
                unset($user['password']);
                unset($warble['user_id']);
                $carbon = new Carbon\Carbon($warble['date']);
                $warble['date'] = $carbon->diffForHumans();
                $warble['user'] = $user;
                $warbles_with_user[] = $warble;
            }
            http_response_code(200);
            echo json_encode(['warbles' => $warbles_with_user]);
        }
        else {
            http_response_code(404);
            echo json_encode(['type' => 'warbles-not-found']);
        }
    }

    if (isset($_GET['hashtag'])) {
        $db = new DBHelper();
        $hashtag = $_GET['hashtag'];
        $hashtag_exists = $db->hashtagExists($hashtag);
        
        if (!is_null($hashtag_exists)) {
            $hashtag_warbles = $db->getByHashtagId($hashtag_exists['id']);

            $all_warbles = [];
            foreach($hashtag_warbles as $hashtag_warble) {
                $warble = $db->getById('warbles', $hashtag_warble['warble_id']);
                $user = $db->getById('users', $warble['user_id']);
                unset($user['password']);
                unset($warble['user_id']);
                $carbon = new Carbon\Carbon($warble['date']);
                $warble['date'] = $carbon->diffForHumans();
                $warble['user'] = $user;
                $all_warbles[] = $warble;
            }
            
            http_response_code(200);
            echo json_encode(['warbles' => $all_warbles]);
        }
        else {
            http_response_code(404);
            echo json_encode(['type' => 'warbles-not-found']);
        }
    }
}