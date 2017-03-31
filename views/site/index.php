<?php include_once(ROOT . '/views/layout/header.php'); ?>

    <div class="blog-header">
        <div class="container">
            <br>
            <h1 class="blog-title">Блог хіміка</h1>
            <p class="lead blog-description">Тут я буду викладати свої програми тренувань та інші корисні статті.</p>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8">


                <?php if(isset($programs)): ?>

                    <?php foreach ($programs as $key => $program): ?>

                        <div class="publication" id="publication<?= $program['program_id'] ?>">
                            <div class="publication-title">
                                <h5><?= $program['program_title'] ?></h5>
                                <span class="publication-author">Автор,&nbsp; <a href="/user/<?= $program['program_user_id'] ?>/"><?= $program['program_user'] ?></a></span>
                                <br><br>
                            </div>
                            <div class="publication-content">
                                <?= $program['program_text'] ?>
                                <br>
                            </div>
                            <hr>
                            <div class="publication-footer">
                                <div class="publication-social">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                            <span class="badge badge-default">0</span>
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-md-7 text-center"></div>
                                        <div class="col-md-3 text-center">
                                            <span class="date">
                                                <?= $program['program_date'] ?>
                                            </span>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="comment-box">

                                    <?php foreach($program['program_comments'] as $comment): ?>

                                    <div class="comment">

                                        <div class="row">
                                            <div class="col-md-2 col-xs-2"><?= $comment['comment_author'] ?></div>
                                            <div class="col-md-7 col-xs-7"><?= $comment['comment_text'] ?></div>
                                            <div class="col-md-3 col-xs-3 comment-date text-right"><?= $comment['comment_date'] ?></div>
                                        </div>

                                    </div>

                                    <?php endforeach; ?>

                                </div>

                                <br>
                                <?php if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])): ?>

                                <div class="row">
                                    <div class="col-md-2 col-xs-2"><?= User::getUserName((isset($_SESSION['user_id']))? $_SESSION['user_id'] : $_COOKIE['user_id']) ?></div>
                                    <div class="col-md-10 col-xs-10 text-center">
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
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary disabled" href="#">Старіші</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Новіші</a>
                </nav>

            </div><!-- /.blog-main -->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <div class="sidebar-module">
                    <h4>Archives</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">Березень 2017</a></li>
                    </ol>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->



<?php include_once(ROOT . '/views/layout/footer.php'); ?>