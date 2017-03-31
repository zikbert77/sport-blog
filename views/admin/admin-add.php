<?php require_once ROOT . '/views/admin/header.php'?>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                <a href="/"><h3>Блог хіміка</h3></a>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/index/">Overview <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/add/">Додати програму</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Analytics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Export</a>
                    </li>
                </ul>


            </nav>

            <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                <h1>Додати програму</h1>

                <section class="row text-center placeholders">
                    <div class="col-6 col-sm-3 placeholder">
                        <div class="col-xs-3 text-left">
                            <?= (isset($success))? $success : '' ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="p-title">Назва:</label>
                                    <input type="text" class="form-control" name="p-title" required>
                                </div>
                                <div class="form-group">
                                    <label for="p-description">Опис:</label>
                                    <textarea name="p-description" class="form-control" cols="10" rows="10"></textarea>
                                </div>
                                <input type="submit" class="btn btn-outline-primary btn-block" value="Add" name="add-submit">
                            </form>

                        </div>
                    </div>

                </section>


            </main>
        </div>
    </div>


    </div>
    </div>
<?php require_once ROOT . '/views/admin/footer.php' ?>