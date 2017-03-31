<?php
require_once ROOT . '/models/User.php';


/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 16.03.2017
 * Time: 20:36
 */
class Training
{

    public static function getComments($id){

        $comments = [];

        $db = Db::getConnection();

        $sql = "SELECT * FROM blog_comments WHERE comment_publication='$id' ORDER BY comment_date ASC";
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch_assoc()){
            $comments[$i]['comment_id'] = $row['comment_id'];
            $comments[$i]['comment_text'] = $row['comment_text'];
            $comments[$i]['comment_date'] = $row['comment_date'];
            $comments[$i]['comment_author'] = User::getUserName($row['comment_author']);
            $i++;
        }

        return $comments;

    }

    public static function getAllTraining()
    {

        $programs = [];

        $db = Db::getConnection();

        $sql = "SELECT * FROM blog_main ORDER BY main_date DESC";
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch_assoc()){
            $programs[$i]['program_id'] = $row['main_id'];
            $programs[$i]['program_title'] = $row['main_title'];
            $programs[$i]['program_text'] = htmlspecialchars_decode($row['main_text']);
            $programs[$i]['program_date'] = $row['main_date'];
            $programs[$i]['program_user_id'] = $row['main_user'];
            $programs[$i]['program_user'] = User::getUserName($row['main_user']);
            $programs[$i]['program_comments'] = self::getComments($row['main_id']);
            $i++;
        }

        return $programs;

    }

    public static function getTrainingByUserId($id)
    {

        $programs = [];

        $db = Db::getConnection();

        $sql = "SELECT * FROM blog_programs WHERE program_user='$id' ORDER BY program_date DESC";
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch_assoc()){
            $programs[$i]['program_id'] = $row['program_id'];
            $programs[$i]['program_title'] = $row['program_title'];
            $programs[$i]['program_text'] = htmlspecialchars_decode($row['program_text']);
            $programs[$i]['program_date'] = $row['program_date'];
            $programs[$i]['program_user_id'] = $row['program_user'];
            $programs[$i]['program_user'] = User::getUserName($row['program_user']);
            $programs[$i]['program_comments'] = self::getComments($row['program_id']);
            $i++;
        }

        return $programs;

    }

}