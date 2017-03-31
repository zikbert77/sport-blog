<?php

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 17.03.2017
 * Time: 16:08
 */
class User
{

    /*Publications*/
    public static function addPublication($publication){

        $db = Db::getConnection();

        $sql = "INSERT INTO blog_programs(program_title, program_text, program_date, program_user) VALUES('{$publication['publication_title']}', '{$publication['publication_text']}', NOW(), '{$publication['publication_author']}')";

        if($result = $db->query($sql)){
            return true;
        }

        return false;

    }

    public static function deletePublication($id, $our_id){
        $db = Db::getConnection();

        $sql = "DELETE FROM blog_programs WHERE program_id='$id' AND program_user='$our_id'";

        if($result = $db->query($sql)){
            $db->query("DELETE FROM blog_comments WHERE comment_publication='$id'");
            return true;
        }

        return false;
    }

    public static function checkUser($hash){

        $user = [];

        $db = Db::getConnection();

        $sql = "SELECT user_id, user_status FROM blog_user WHERE user_hash='$hash'";
        $result = $db->query($sql);

        if($row = $result->fetch_assoc()){
            $user['user_id'] = $row['user_id'];
            $user['user_status'] = $row['user_status'];
            return $user;
        }

        return false;
    }

    public static function checkUserName($u_name){

        $user = [];

        $db = Db::getConnection();

        $sql = "SELECT user_name FROM blog_user WHERE user_name='$u_name'";
        $result = $db->query($sql);

        if($result->num_rows == 0){
            return false;
        }

        return true;
    }

    public static function checkUserNameLength($u_name){
        if(strlen($u_name) < 4 || strlen($u_name) > 10){
            return true;
        }
        return false;
    }

    public static function checkUserPasswordLength($u_pass){
        if(strlen($u_pass) < 5){
            return true;
        }
        return false;
    }

    public static function registerUser($user){
        $db = Db::getConnection();
        $sql = "INSERT INTO blog_user(user_name, user_pass, user_hash) VALUES ('{$user['user_name']}', '{$user['user_password']}', '{$user['user_hash']}')";
        $result = $db->query($sql);

        return true;
    }

    public static function getUserName($id){

        $user = [];

        $db = Db::getConnection();

        $sql = "SELECT user_name FROM blog_user WHERE user_id='$id'";
        $result = $db->query($sql);

        if($row = $result->fetch_assoc()){
            $user['user_name'] = $row['user_name'];
            return $user['user_name'];
        }

        return false;

    }

    public static function searchUser($userName){
        $db = Db::getConnection();
        $sql = "SELECT user_id, user_name FROM blog_user WHERE user_name LIKE '%$userName%'";
        $result = $db->query($sql);

        if($result->num_rows > 0){

            while ($row = $result->fetch_assoc()){
                echo '<a href="/user/'. $row['user_id'] .'">'. $row['user_name'] .'</a> <br>';
            }

        } else {
            echo 'Нікого не знайдено';
        }

        return true;
    }

    /*Friends system*/

    public static function addFriendRequest($our_id, $to_friend_id){

        $friend_one = $our_id;
        $friend_two = $to_friend_id;

        $db = Db::getConnection();
        $sql = "INSERT INTO blog_friends(friend_one, friend_two) VALUES ('$friend_one', '$friend_two')";

        if($result = $db->query($sql)){
            return true;
        }

        return false;
    }

    public static function checkFriendships($our_id, $to_friend_id){

        $db = Db::getConnection();
        $sql = "SELECT friend_one, friend_two, status FROM blog_friends WHERE(friend_one='$our_id' OR friend_two='$our_id') AND (friend_one='$to_friend_id' OR friend_two='$to_friend_id')";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        if(($row['friend_one'] == $our_id || $row['friend_two'] == $our_id) && $row['status'] == '0'){
            return 'request_sent';
        } elseif(($row['friend_one'] == $our_id || $row['friend_two'] == $our_id) && $row['status'] == '1') {
            return 'you_are_friends';
        }  else {
            return false;
        }

    }

    public static function checkFriendRequest($our_id) {
        $db = Db::getConnection();
        $sql = "SELECT friend_one FROM blog_friends WHERE friend_two='$our_id' AND status='0'";
        $result = $db->query($sql);


        $friend_requests = [];
        $i = 0;

        while($row = $result->fetch_assoc()){
            $friend_requests[$i] = $row['friend_one'];
            $i++;
        }

        if(empty($friend_requests))
            return false;

        return $friend_requests;
    }

    public static function confirmFriendship($ourId, $userId){

        $db = Db::getConnection();
        $sql = "UPDATE blog_friends SET status='1' WHERE (friend_one='$ourId' OR friend_two='$ourId') AND (friend_one='$userId' OR friend_two='$userId')";
        $result = $db->query($sql);


        return true;
    }

    public static function getFriends($ourId){
        $db = Db::getConnection();
        $sql = "SELECT friend_one, friend_two FROM blog_friends WHERE (friend_one='$ourId' OR friend_two='$ourId') AND status='1'";
        $result = $db->query($sql);


        $friends = [];
        $i = 0;

        while($row = $result->fetch_assoc()){

            if($row['friend_one'] == $ourId){
                $friends[$i] = $row['friend_two'];
            } else {
                $friends[$i] = $row['friend_one'];
            }

            $i++;
        }

        if(empty($friends))
            return false;

        return $friends;
    }

}