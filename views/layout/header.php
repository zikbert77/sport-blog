<?php

if(isset($title)) {
    $title .= ' - Блог хіміка';
} else {
    $title = 'Блог хіміка';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $title ?></title>
    <?= isset($meta_name)? '<meta name="keywords" content="'. $meta_name .'">' : '' ?>
    <?= isset($meta_name)? '<meta name="description" content="'.$meta_name.' - купити на Brand City ☑ Найкраща ціна $">' : '' ?>
      <meta name="keywords" content="Sport, спорт, качалка, хімія, тренування, програми тренувань.">
      <meta name="description" content="Спотривний блог хіміка Бондарука Богдана.">

      <link rel="stylesheet" href="/template/css/style.css">

      <?php if(isset($page) && $page == 'profile')echo '<link rel="stylesheet" href="/template/css/profile.css">'; ?>
    <!-- Bootstrap -->
      <link rel="stylesheet" href="/template/css/bootstrap.css">

    <!--Font Awesome-->
      <link rel="stylesheet" href="/template/css/font-awesome.css">

      <!--NIC wysivygn editor-->
      <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
      <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="/">БХ</a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Головна <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                        <ul class="navbar-nav mr-right">

                            <?php if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/user/<?= (isset($_SESSION['user_id']))? $_SESSION['user_id'] : $_COOKIE['user_id'] ?>/">Профіль</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/logout/">Вийти</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/login/">Увійти</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/register/">Зареєструватися</a>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>