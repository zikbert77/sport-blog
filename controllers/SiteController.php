<?php

include_once ROOT . '/models/Training.php';
include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Site.php';

class SiteController {

    
    public function actionIndex(){

        $info = [];
        $info['REFERER'] = (!empty($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER'] : false;
        $info['IP'] = (!empty($_SERVER['REMOTE_ADDR']))? $_SERVER['REMOTE_ADDR'] : false;

        if($info['REFERER'] || $info['IP']){
            Site::createInfo($info);
        }

        $title = 'Головна';
        $page = 'main';
        $programs = Training::getAllTraining();

        
        require_once(ROOT . '/views/site/index.php');
        return true;
    }


    public function actionCreateComment(){
        if (isset($_GET['publication_id']) && isset($_GET['publication_value'])){

            $comment = [];
            $comment['comment_publication_id'] = intval($_GET['publication_id']);
            $comment['comment_value'] = trim(htmlspecialchars(addslashes($_GET['publication_value'])));
            $comment['comment_author'] = $_SESSION['user_id'];

            Site::createComment($comment);
            $referer = $_SERVER['HTTP_REFERER'];

            header("Location: $referer");

        }

        return true;
    }

}