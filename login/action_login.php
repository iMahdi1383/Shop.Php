<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno())
    exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());

$query = "
         SELECT *
         FROM `users`
         WHERE username = '$username' AND password = '$password' 
         ";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
?>
<html lang="fa-IR">
<head>
    <meta charset="utf-8">
    <title>فروشگاه آکولاد | ورود</title>
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
                        if ($row) {
                            $_SESSION['state_login'] = true;
                            $_SESSION['realname'] = $row['realname'];
                            $_SESSION['username'] = $row['username'];
                            if($row['type'] == 1)
                                $_SESSION['user_type'] = "1";
                            else if($row['type'] == 0)
                                $_SESSION['user_type'] = "0";
                            echo('
                                <h4 class="styles__title___3RZ4b">'. $row["realname"].' عزیز</h4>
                                <div class="modal__modal-footer___1wfo3">به فروشگاه آکولاد خوش آمدید</div>
                                <script type="text/javascript">
                                    setTimeout(function () { location.replace("../")},2000);
                                </script>
                            ');
                            unset($row);
                        } else
                            echo('
                                <p class="styles__title___3RZ4b" style="color: #80003a; font-weight: bold">
                                    نام کاربری یا کلمه عبور اشتباه است
                                </p>
                            ');
                        mysqli_close($link);
                        ?>
                        <div class="modal__modal-footer___1wfo3"><a href="javascript:history.go(-1)">بازگشت</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
