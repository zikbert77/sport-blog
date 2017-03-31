<?php include_once(ROOT . '/views/layout/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-sidebar">
                                <!-- END SIDEBAR USERPIC -->
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name">
                                        <?= $userName ?>
                                    </div>
                                    <!--<div class="profile-usertitle-job">
                                        Main administrator
                                    </div>-->
                                </div>
                                <!-- END SIDEBAR USER TITLE -->

                                <?php if($guest && (isset($_SESSION['user_id']) || isset($_COOKIE['user_id']))): ?>

                                    <?php

                                    if (isset($friendships) && $friendships == 'request_sent'){
                                        echo '<center><h5>Запрос надіслано</h5></center>';
                                    } elseif (isset($friendships) && $friendships == 'you_are_friends'){
                                        echo '<center><h5>Ви друзі</h5></center>';
                                    } else {
                                        echo '<!-- SIDEBAR BUTTONS -->
                                        <div class="profile-userbuttons">
                                            <button type="button" user-id="' . $id . '" id="add-to-friend" class="btn btn-outline-success btn-block">Додати до друзів</button>
                                            <!--<button type="button" class="btn btn-outline-info btn-block">Повідомлення</button>-->
                                        </div>
                                        <!-- END SIDEBAR BUTTONS -->';
                                    }

                                    ?>

                                <?php endif; ?>

                            </div>
                            <hr>
                            <div class="friends-container">
                                <?php if(!empty($friends)): ?>
                                Друзі (<?= count($friends) ?>)
                                <hr>

                                <?php foreach ($friends as $friend): ?>


                                            <a href="/user/<?= $friend ?>/">
                                                <span><?= User::getUserName($friend) ?></span>
                                            </a><br>


                                <?php endforeach; ?>

                                    <?php else: ?>
                                    <span>Друзів не знайдено</span>
                                <?php endif; ?>
                                <hr>
                                <?php if(!$guest): ?>
                                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#myModal">
                                        Знайти друзів
                                    </button><br>
                                <?php endif; ?>
                                <div class="friend-request-box">
                                    <?php if(isset($friendRequests) && $friendRequests): ?>
                                        <?php foreach ($friendRequests as $request): ?>
                                            <h4>Заявки у друзі</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="/user/<?= $request ?>/">
                                                        <span><?= User::getUserName($request) ?></span>
                                                    </a>
                                                    <span id="confirm-friendships" user-id="<?= $request ?>" our-id="<?= $our_id ?>" title="Додати в друзі" style="cursor: hand;"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>



                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="profile-content">
                                <div class="publication-container">
                                    <h4>Публікації користувача</h4>
                                    <hr>

                                    <?php if(!$guest): ?>

                                        <?= (isset($success))? $success : '' ?>
                                        <div class="create-program">
                                            <form id="create-publicatio-form" action="" method="post">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="publication-title" placeholder="Назва" required>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" style="..." name="publication-text" id="publicatio-create-textarea"  rows="10" placeholder="Введіть програму"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="publication-create" class="btn btn-outline-primary" value="Створити">
                                                </div>

                                            </form>
                                        </div>

                                    <?php endif; ?>

                                    <?php if(isset($programs)): ?>

                                        <?php foreach ($programs as $key => $program): ?>

                                            <div class="publication" id="publication<?= $program['program_id'] ?>">
                                                <div class="publication-title">
                                                    <?= (!$guest)? '<div class="pull-right delete-program" program-id="' . $program['program_id'] . '" title="Видалити"><i class="fa fa-trash-o" aria-hidden="true"></i></div>' : ''  ?>
                                                    <h5><?= $program['program_title'] ?></h5>
                                                    <span class="publication-author"><span class="small"><?= $program['program_date'] ?></span>,&nbsp; <a href="/user/<?= $program['program_user_id'] ?>/"><?= $program['program_user'] ?></a></span>
                                                    <br><br>
                                                </div>
                                                <div class="publication-content">
                                                    <?= $program['program_text'] ?>
                                                    <br>
                                                </div>
                                                <hr>
                                                <div class="publication-footer">

                                                    <div class="comment-box">

                                                        <?php foreach($program['program_comments'] as $comment): ?>

                                                            <div class="comment">

                                                                <div class="row">
                                                                    <div class="col-md-2"><?= $comment['comment_author'] ?></div>
                                                                    <div class="col-md-7"><?= $comment['comment_text'] ?></div>
                                                                    <div class="col-md-3 comment-date text-right"><?= $comment['comment_date'] ?></div>
                                                                </div>

                                                            </div>

                                                        <?php endforeach; ?>
                                                        <br>
                                                    </div>


                                                    <?php if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])): ?>

                                                        <div class="row">
                                                            <div class="col-md-2"><?= User::getUserName((isset($_SESSION['user_id']))? $_SESSION['user_id'] : $_COOKIE['user_id']) ?></div>
                                                            <div class="col-md-10 text-center">
                                                                <form class="inline-form" onsubmit="return false">
                                                                    <input type="text" id="publication-comment-<?= $program['program_id'] ?>" onchange="createComent(<?= $program['program_id'] ?>)" class="form-control form-control-sm" placeholder="Залишити коментар">
                                                                </form>
                                                            </div>
                                                        </div>

                                                    <?php else: ?>
                                                        <center><h3>You must be log in to comment</h3></center>
                                                    <?php endif; ?>

                                                </div>
                                            </div>

                                        <?php endforeach; ?>




                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Пошук друзів</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" onsubmit="return false">
                        <div class="form-group">
                            <label for="search-friend">Логін:</label>
                            <input type="text" name="search-friend" class="form-control" placeholder="Введіть логін">
                        </div>
                    </form>
                    <div class="friend-output"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Закрити</button>
                </div>
            </div>
        </div>
    </div>

<?php include_once(ROOT . '/views/layout/footer.php'); ?>