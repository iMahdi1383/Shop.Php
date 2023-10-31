<?php
session_start();
?>
<html lang="fa-IR">
<head>
    <meta charset="utf-8">
    <title>فروشگاه آکولاد | ثبت سفارش</title>
    <link rel="stylesheet" href="../_files/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
</head>
<body>
<div class="modal__overlay-fixed-open___T89Rr modal__overlay-fixed___3Lxhl modal__overlay___3I1-i modal__fixed___2wzGG modal__open___1FXWL">
    <div class="modal__modal-wrapper___1cB-2">
        <div class="modal__modal-inner___35euL">
            <a href="../">
                <span class="modal__modal-close-fade-in___7klXv modal__modal-close___3JMip modal__animated___P-pr_ modal__fade-in___1OZxq icons__icon-close___1FcTX icons__icons___XoCGh">
                </span>
            </a>
            <div class="modal__modal-zoom-in___3o_8X modal__modal-normal___xAhLb modal__modal___fG-9Z modal__animated___P-pr_ modal__zoom-in___1G3GS">
                <div class="modal__modal-content___2gLRe">
                    <?php
                    if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)) {
                        echo('
                                    <script type="text/javascript">
                                        location.replace("../");
                                    </script>
                                 ');
                    }

                    $pro_code = $_POST['pro_code'];
                    $pro_name = $_POST['pro_name'];
                    $pro_qty = $_POST['pro_qty'];
                    $pro_price = $_POST['pro_price'];
                    $total_price = $_POST['all_price'];
                    $realname = $_POST['realname'];
                    $email = $_POST['email'];
                    $mobile = $_POST['mobile'];
                    $address = $_POST['address'];
                    $detail = $_POST['detail'];
                    $username = $_SESSION['username'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];


                    $link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
                    if (mysqli_connect_errno()) exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());

                    date_default_timezone_set("Asia/Tehran");
                    $date = date('Y/m/d');
                    $query = "
                                  INSERT INTO orders(
                                                     id,
                                                     username,
                                                     firstname,
                                                     lastname,
                                                     orderdate,
                                                     pro_code,
                                                     pro_qty,
                                                     pro_price,
                                                     mobile,
                                                     address,
                                                     trackcode,
                                                     state,
                                                     detail
                                                    )
                                    VALUES(
                                           '',
                                           '$username',
                                           '$firstname',
                                           '$lastname',
                                           '$date',
                                           '$pro_code',
                                           '$pro_qty',
                                           '$pro_price',
                                           '$mobile',
                                           '$address',
                                           '000000000000000000000000',
                                           '0',
                                           '$detail'
                                    )
                             ";
                    if (mysqli_query($link, $query) === true) {
                        ?>
                        <h4 class="styles__title___3RZ4b">
                            <?php echo($firstname . " " . $lastname) ?> عزیز
                        </h4>
                        <div class="modal__modal-footer___1wfo3" style="line-height: 160%">
                            سفارش شما در تاریخ
                            <br>
                            ( <?php echo($date); ?> )
                            <br>
                            در سامانه ثبت شد
                        </div>
                        <?php
                        $query = "
                                  UPDATE `products`
                                  SET `pro_qty` = `pro_qty` - $pro_qty
                                  WHERE 1
                                 ";
                        mysqli_query($link, $query);
                    } else {
                        ?>
                        <p class="styles__title___3RZ4b" style="color: #80003a; font-weight: bold">
                            متاسفانه ارتباط با پایگاه داده با خطا مواجه شد.
                            <br>
                            لطفا با پشتیبانی تماس بگیرید.
                        </p>
                        <?php
                    }
                    mysqli_close($link);
                    ?>
                    <div class="modal__modal-footer___1wfo3">
                        <a href="../">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
