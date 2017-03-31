<footer>

    <div class=" blog-footer container">
        <hr>
        <p><a href="http://zikbert77.zzz.com.ua/" target="_blank">Bogdan Bondaruk</a> &nbsp; 2015-2017</p>
    </div>
</footer>



<script src="https://code.jquery.com/jquery-3.2.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="/template/js/bootstrap.js"></script>

<script>
    function createComent(id){
        var publicId = id;
        var publicValue = $("input#publication-comment-" + publicId).val();

        if(publicValue != ""){

            var properties = {
                publication_id: publicId,
                publication_value: publicValue
            }

            $.get("/site/createComment/", properties, function (data) {
                location.reload();
            });
        }
    }
</script>

<?php if($page=='profile'): ?>
    <?php if(!$guest): ?>

        <script>

            $(document).ready(function () {

                $(function () {
                    $("input[name='search-friend']").keyup(function () {

                        var search = $(this).val();
                        $.ajax({
                            type: "POST",
                            url: "/user/searchUser/",
                            data: {"search": search},
                            cache: false,
                            success: function (response) {
                                $(".friend-output").html(response);
                            }
                        });
                        return false;
                    });
                });

                $(".delete-program").click(function () {

                    var checkDelete = confirm("Видалити?");
                    var programId = $(this).attr("program-id");

                    if (checkDelete){
                        var properties = {
                            delete: true,
                            id: programId
                        }

                        $.get("/user/deletePublication/", properties, function (data) {
                            location.reload();
                        });

                    } else {
                        alert('Видалення відмінено');
                    }
                });

            });



        </script>

    <?php endif; ?>
<script>

        $("#add-to-friend").click(function () {
            var properties = {
                userId: $("#add-to-friend").attr("user-id"),
                addToFriend: true
            };

            $.get("/user/addToFriend/", properties, function (data) {
                location.reload();
            });
        });

        $("#confirm-friendships").click(function () {
            var properties = {
                userId: $("#confirm-friendships").attr("user-id"),
                ourId:  $("#confirm-friendships").attr("our-id"),
                confirmFriend: true
            };

            $.get("/user/confirmFriend/", properties, function (data) {
                location.reload();
            });
        });

</script>
<?php endif; ?>

    </body>
</html>