<?php

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 18.03.2017
 * Time: 17:32
 */
class Site
{
    public static function createComment($comment){

        $db = Db::getConnection();
        $sql = "INSERT INTO blog_comments(comment_text, comment_publication, comment_author) VALUES('{$comment['comment_value']}', '{$comment['comment_publication_id']}', '{$comment['comment_author']}')";

        $result = $db->query($sql);

        return true;
    }

    public static function createInfo($info){
        $db = Db::getConnection();
        $sql = "SELECT * FROM blog_statistic WHERE stat_ip='{$info['IP']}'";
        $result = $db->query($sql);

        if($result->num_rows == 0){
            $db->query("INSERT INTO blog_statistic(stat_ip, stat_referer, stat_date) VALUES('{$info['IP']}', '{$info['REFERER']}', NOW())");
        } else {

            $getView = $db->query("SELECT stat_view FROM blog_statistic WHERE stat_ip='{$info['IP']}'");
            $row = $getView->fetch_assoc();
            $views = $row['stat_view'];
            $views+=1;

            $db->query("UPDATE blog_statistic SET stat_view='$views', stat_date=NOW() WHERE stat_ip='{$info['IP']}'");
        }

        return true;
    }
}