<?php

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 16.03.2017
 * Time: 21:54
 */
class Admin
{

    public static function addProgram($program){

        $db = Db::getConnection();

        $sql = "INSERT INTO blog_main(main_title, main_text, main_date, main_user) VALUES('{$program['title']}', '{$program['text']}', NOW(), '{$program['user']}')";

        if($result = $db->query($sql)){
            return true;
        }

        return false;

    }

    public static function getStatistic(){
        $db = Db::getConnection();
        $sql = "SELECT * FROM blog_statistic";
        $result = $db->query($sql);

        $stat = [];
        $i = 0;

        while ($row = $result->fetch_assoc()){

            $stat[$i]['stat_ip'] = $row['stat_ip'];
            $stat[$i]['stat_ref'] = $row['stat_referer'];
            $stat[$i]['stat_date'] = $row['stat_date'];
            $stat[$i]['stat_view'] = $row['stat_view'];

            $i++;
        }

        return $stat;

    }

}