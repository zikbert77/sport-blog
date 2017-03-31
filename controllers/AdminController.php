<?php

require_once ROOT . '/models/Admin.php';

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 05.03.2017
 * Time: 10:47
 */
class AdminController
{
    private $user_id;

    public function __construct()
    {
        $this->user_id = isset($_SESSION['admin_id'])? $_SESSION['admin_id'] : false;

    }

    public function actionIndex(){

        if(isset($_SESSION['admin_id']) || isset($_COOKIE['admin_id'])){

            $title = 'Overview';

            $statistic = Admin::getStatistic();

            $unique = 0;
            $views = 0;

            foreach ($statistic as $stat){

                $unique += 1;
                $views += $stat['stat_view'];
            }

            require_once ROOT . '/views/admin/admin-index.php';

        } else {
            header("Location: /");
            exit(0);
        }

        return true;
    }
    public function actionAdd(){

        if(isset($_SESSION['admin_id']) || isset($_COOKIE['admin_id'])){

            $title = 'Add';


            if(isset($_POST['add-submit'])){

                $program['user']  = $this->user_id;
                $program['title'] = trim(strip_tags(htmlspecialchars($_POST['p-title'])));
                $program['text']  = trim(strip_tags(htmlspecialchars($_POST['p-description'])));

                if(Admin::addProgram($program)){
                    $success = '<p class="bg-success">Успішно додано</p>';
                }

            }

            require_once ROOT . '/views/admin/admin-add.php';

        } else {
            header("Location: /");
            exit(0);
        }

        return true;
    }


}