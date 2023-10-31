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
    <title>فروشگاه آکولاد | عضویت</title>
    <link rel="stylesheet" href="../_files/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
</head>

<body>
<script type="text/javascript">
    function check_register() {
        let realname, username, email, password, repassword;
        realname = document.getElementById("registerRealname").value;
        username = document.getElementById("registerUsername").value;
        email = document.getElementById("registerEmail").value;
        password = document.getElementById("registerPassword").value;
        repassword = document.getElementById("registerRepassword").value;
        if (realname === "") alert("وارد کردن نام واقعی الزامی است");
        else if (username === "") alert("وارد کردن نام کاربری الزامی است");
        else if (email === "") alert("وارد کردن ایمیل الزامی است");
        else if (password === "" || repassword === "") alert("وارد کردن رمز عبور و تکرار آن الزامی است");
        else if (password !== repassword) alert("رمز عبور و تکرار آن یکسان نیستند");
        else if (confirm("از صحت اطلاعات وارد شده اطمینان دارید؟"))
            document.register.submit();
    }
</script>
    <div class="modal__overlay-fixed-open___T89Rr modal__overlay-fixed___3Lxhl modal__overlay___3I1-i modal__fixed___2wzGG modal__open___1FXWL">
    <div class="modal__modal-wrapper___1cB-2">
        <div class="modal__modal-inner___35euL">
            <a href="../">
                <span class="modal__modal-close-fade-in___7klXv modal__modal-close___3JMip modal__animated___P-pr_ modal__fade-in___1OZxq icons__icon-close___1FcTX icons__icons___XoCGh">
                </span>
            </a>
            <div class="modal__modal-zoom-in___3o_8X modal__modal-normal___xAhLb modal__modal___fG-9Z modal__animated___P-pr_ modal__zoom-in___1G3GS">
                <form action="action_register.php" method="POST" name="register">
                    <div class="modal__modal-content___2gLRe">
                        <h4 class="styles__title___3RZ4b">
                            عضویت در فروشگاه
                        </h4>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="realname"
                                       class="form__text-box___3esxj form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="registerRealname" type="text" placeholder="نام واقعی" value=""/>
                            </div>
                        </div>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="username"
                                       class="form__text-box___3esxj form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="registerUsername" type="text" placeholder="نام کاربری" value=""/>
                            </div>
                        </div>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="email"
                                       class="form__text-box___3esxj form__ltr___2HdeQ form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="registerEmail" type="email" placeholder="آدرس ایمیل" value=""/>
                            </div>
                        </div>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="password"
                                       class="form__text-box___3esxj form__ltr___2HdeQ form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="registerPassword" type="password" placeholder="کلمه عبور" value=""/>
                            </div>
                        </div>
                        <div class="styles__custom-control-row___1hoKF">
                            <div class="form__control-wrapper___37Mo-">
                                <input name="repassword"
                                       class="form__text-box___3esxj form__ltr___2HdeQ form__text-box-centered___1HPdD form__text-box___3esxj"
                                       id="registerRepassword" type="password" placeholder="تکرار کلمه عبور" value=""/>
                            </div>
                        </div>
                        <button type="button" onclick="check_register()"
                                class="button__btn-normal-success___1JY6- button__btn-normal___299V7 button__btn___3Wejk button__success___2V0M8 styles__button___285We">
                            ایجاد حساب کاربری
                        </button>
                        <div class="modal__modal-footer___1wfo3">
                            قبلا عضو شده اید؟
                            <a href="../login"><span class="styles__link___3uu51">وارد شوید</span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>