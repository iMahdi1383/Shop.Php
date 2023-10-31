<?php
session_start();
if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
    echo(' 
        <script type="text/javascript">
            location.replace("/AkoladShop/index.php");
        </script>
    ');
}
?>

<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8"/>
    <title>فروشگاه آکولاد | ورود</title>
    <link rel="stylesheet" href="../_files/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
</head>
<body>
<script type="text/javascript">function check_login() {
        let username, password;
        username = document.getElementById("loginUsername").value;
        password = document.getElementById("loginPassword").value;
        if (username === "") alert("وارد کردن نام کاربری الزامی است");
        else if (password === "") alert("وارد کردن رمز عبور الزامی است");
        else
            document.login.submit();
    }
</script>
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
                        <h4 class="styles__title___3RZ4b"> ورود به حساب کاربری</h4>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="username"
                                       class="form__text-box___3esxj form__ltr___2HdeQ form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="loginUsername" type="text"
                                       placeholder="نام کاربری" value=""/>
                            </div>
                        </div>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="password"
                                       class="form__text-box___3esxj form__ltr___2HdeQ form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="loginPassword" type="password"
                                       placeholder="کلمه عبور" value=""/>
                            </div>
                        </div>
                        <button type="button" onclick="check_login()"
                                class="button__btn-normal-success___1JY6- button__btn-normal___299V7 button__btn___3Wejk button__success___2V0M8 styles__button___285We">
                            ورود به حساب کاربری
                        </button>
                        <div class="modal__modal-footer___1wfo3">
                            کاربر جدید هستید؟ همین حالا <a href="../register">
                            <span
                                    class="styles__link___3uu51">
                                ثبت نام
                            </span>
                            </a>
                            کنید!
                        </div>
                        <div class="modal__modal-footer___1wfo3">
                            <span class="styles__link___3uu51">بازیابی کلمه عبور</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>