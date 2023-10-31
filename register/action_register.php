<html lang="fa-IR">
<head>
    <meta charset="utf-8">
    <title>فروشگاه آکولاد | عضویت</title>
    <link rel="stylesheet" href="../_files/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
</head>
<body>
<div class="modal__overlay-fixed-open___T89Rr modal__overlay-fixed___3Lxhl modal__overlay___3I1-i modal__fixed___2wzGG modal__open___1FXWL">
    <div class="modal__modal-wrapper___1cB-2">
        <div class="modal__modal-inner___35euL">
            <a href="javascript:history.go(-1)">
                <span class="modal__modal-close-fade-in___7klXv modal__modal-close___3JMip modal__animated___P-pr_ modal__fade-in___1OZxq icons__icon-close___1FcTX icons__icons___XoCGh">
                </span>
            </a>
            <div class="modal__modal-zoom-in___3o_8X modal__modal-normal___xAhLb modal__modal___fG-9Z modal__animated___P-pr_ modal__zoom-in___1G3GS">
                <form action="action_login.php" method="post" name="login">
                    <div class="modal__modal-content___2gLRe">
                        <?php
                        $realname = $_POST['realname'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $repassword = $_POST['repassword'];
                        $email = $_POST['email'];

                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                            exit('
                                    <p class="styles__title___3RZ4b" style="color: #80003a; font-weight: bold">
                                        پست الکترونیک وارد شده صحیح نیست
                                    </p>
                                    <div class="modal__modal-footer___1wfo3">
                                        <a href="javascript:history.go(-1)">بازگشت</a>
                                    </div>
                                ');

                        $link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
                        if (mysqli_connect_errno())
                            exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
                        $query = "
                                INSERT INTO users(
                                    `realname`,
                                    `username`,
                                    `password`,
                                    `email`,
                                    `type`
                                )
                                VALUES(
                                    '$realname',
                                    '$username',
                                    '$password',
                                    '$email',
                                    '0'
                                );
                                ";
                        if (mysqli_query($link, $query) === true)
                            echo('
                                <h4 class="styles__title___3RZ4b">' . $realname . ' عزیز</h4>
                                <div class="modal__modal-footer___1wfo3">عضویت شما در فروشگاه آکولاد با موفقیت انجام شد</div>
                                <script type="text/javascript">
                                    setTimeout(function () { location.replace("../")},2000);
                                </script>
                               ');
                        else
                            echo('
                                  <p class="styles__title___3RZ4b" style="color: #80003a; font-weight: bold">
                                    متاسفانه عضویت شما با خطا مواجه شد.
                                  </p>
                                  ');
                        mysqli_close($link);
                        ?>
                        <div class="modal__modal-footer___1wfo3">
                            <a href="javascript:history.go(-1)">بازگشت</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
