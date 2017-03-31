<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Training.php';

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 17.03.2017
 * Time: 16:40
 */
class UserController
{

    public function actionProfile($id){
        $id = intval($id);
        $our_id = (isset($_SESSION['user_id']))? $_SESSION['user_id'] : (isset($_COOKIE['user_id']))? $_COOKIE['user_id'] : false;


        if($id){

            $friends = User::getFriends($id);

            if((isset($_SESSION['user_id']) && $id == $_SESSION['user_id']) || isset($_SESSION['admin_id'])){
                $guest = false;
            } elseif(isset($_COOKIE['user_id']) && $id == $_COOKIE['user_id']){
                $guest = false;
            } else {
                $guest = true;
            }

            if(!$guest){

                $friendRequests = User::checkFriendRequest($our_id);

                if(isset($_POST['publication-create'])){

                    $errors = false;
                    $publication = [];

                    $publication['publication_title']  = trim(htmlspecialchars(addslashes(strip_tags($_POST['publication-title']))));
                    $publication['publication_text']   = trim(htmlspecialchars(addslashes($_POST['publication-text'])));
                    $publication['publication_author'] = intval($id);

                    if (empty($publication['publication_title']) || empty($publication['publication_text'])){
                        $errors[] = 'Заповніть усі поля';
                    }

                    if(!$errors){

                        if (User::addPublication($publication)){
                            $success = '<p class="bg-success" style="padding: 5px;">Успішно додано</p>';
                            header("Location: /user/$our_id/");
                        }

                    }

                }

            } else {

                $friendships = User::checkFriendships($our_id, $id);
            }


            $userName = User::getUserName($id);

            $title = $userName;
            $page = 'profile';

            $programs = Training::getTrainingByUserId($id);

            require_once(ROOT . '/views/user/index.php');

        } else {
            header("Location: /");
        }

        return true;
    }

    public function actionDeletePublication(){
        if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){

            if (isset($_GET['delete']) && $_GET['delete']){

                $id = intval($_GET['id']);
                $our_id = (isset($_SESSION['user_id']))? $_SESSION['user_id'] : (isset($_COOKIE['user_id']))? $_COOKIE['user_id'] : false;

                User::deletePublication($id, $our_id);
            }

        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionSearchUser(){
        if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){

            if (isset($_POST['search'])){

                $searchUserName = trim(addslashes(htmlspecialchars(stripslashes($_POST['search']))));

                if($searchUserName == ''){
                    exit("Введіть логін");
                }

                User::searchUser($searchUserName);

            }

        } else {
            header("Location: /");
        }

        return true;
    }

    public function actionAddToFriend(){
        if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){

            if (isset($_GET['addToFriend']) && $_GET['addToFriend']){
                $ourId = (isset($_SESSION['user_id']))? $_SESSION['user_id'] : $_COOKIE['user_id'];
                $userToFriendId = intval($_GET['userId']);

                User::addFriendRequest($ourId, $userToFriendId);

            }

        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionConfirmFriend(){
        if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){

            if (isset($_GET['confirmFriend']) && $_GET['confirmFriend']){
                $ourId = intval($_GET['ourId']);
                $userToFriendId = intval($_GET['userId']);

                User::confirmFriendship($ourId, $userToFriendId);

            }

        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionRegister(){
        if(!isset($_SESSION['user_id']) || !isset($_COOKIE['user_id'])){
            if(isset($_POST['registration-submit'])){

                $user['user_name'] = trim(htmlspecialchars(addslashes(strip_tags($_POST['rg_username']))));
                $u_pass1 = trim($_POST['rg_password1']);
                $u_pass2 = trim($_POST['rg_password2']);

                $errors = false;

                if ($u_pass1 == $u_pass2){
                    $user['user_password'] = $u_pass1;
                } else {
                    $errors[] = "Passwords must be same";
                }

                if (User::checkUserName($user['user_name'])){
                    $errors[] = 'Username already exist';
                }

                if (User::checkUserNameLength($user['user_name'])){
                    $errors[] = 'Username must be between 4 and 10 symbols';
                }

                if (User::checkUserPasswordLength($user['user_password'])){
                    $errors[] = 'Too short password! Password must be more than 5 symbols';
                }

                if (empty($user['user_name']) || empty($u_pass1) || empty($u_pass2)){
                    $errors[] = 'Please fill all fields';
                }

                if (!$errors){

                    $hash = $user['user_name']. ';' . $user['user_password'];
                    $hash = md5($hash);
                    $user['user_hash'] = $hash;

                    $user['user_password'] = md5($user['user_password']);

                    User::registerUser($user);

                    header('Refresh: 3; URL='.'/login/');
                    $success = '<p>Registration complete!</p>';
                }


            }

            require_once ROOT . '/views/user/register.php';
        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionLogin(){

        if(!isset($_SESSION['user_id']) || !isset($_COOKIE['user_id'])){
            if(isset($_POST['login-submit'])){

                $u_name = trim(htmlspecialchars($_POST['lg_username']));
                $u_pass = trim(htmlspecialchars($_POST['lg_password']));
                $remember = isset($_POST['lg_remember'])? $_POST['lg_remember'] : 0;

                $hash = $u_name . ';' . $u_pass;
                $hash = md5($hash);

                $user = User::checkUser($hash);

                if($user){

                    $_SESSION['user_id']  = $user['user_id'];
                    $_SESSION['admin_id'] = ($user['user_status'] == 1)? $user['user_id'] : false;

                    if(!$_SESSION['admin_id']){
                        unset($_SESSION['admin_id']);
                    }

                    if ($remember == 1){
                        setcookie("user_id", $user['user_id'], time()+43200, "/");
                    } else {
                        setcookie("user_id", $user['user_id'], time()+3600, "/");
                    }


                    header("Location: /admin/index/");
                } else {
                    header("Location: /login/");
                }
            }

            require_once ROOT . '/views/user/login.php';
        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionLogout(){


        if (isset($_SESSION['admin_id'])){
            unset($_SESSION['admin_id']);
        }

        if (isset($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
        }

        if (isset($_COOKIE['user_id'])){
            setcookie("user_id", "", time()-999999, '/');
            header("Location: /");
            exit();
        }

        header("Location: /");

        return true;
    }

}