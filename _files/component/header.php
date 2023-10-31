<?php session_start(); ?> <!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8"/>
    <title>فروشگاه آکولاد</title>
    <link rel="stylesheet" href="/AkoladShop/_files/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
</head>
<body class="store-body">
<div id="root">
    <div>
        <div class="styles__empty___3WCoC"></div>
        <div class="general__wrapper___124c8">
            <div class="general__main___3QNTy general__clear___2ZeHL">
                <div class="styles__header___1ADjf styles__margin-bottom___3G8Xh">
                    <div class="styles__inner___3Fe0f general__clear___2ZeHL">
                        <div class="styles__menu-toggle___3K7Ak">
                            <div class="icons__icon-menu___1ZeRx icons__icons___XoCGh"></div>
                        </div>
                        <div class="styles__logo___yh3uJ styles__right-side___2YDqU">
                            <a class="styles__logo-link___2b5DI" href="/AkoladShop/">
                                <img class="styles__logo-image___ciAUw" src="/AkoladShop/_files/img/logo/1.png" alt="فروشگاه آکولاد"/>
                            </a>
                        </div>
                        <div class="styles__menu___H45df general__clear___2ZeHL styles__menu___3C8WC">
                            <span class="styles__close-menu___3DgJn icons__icon-close___1FcTX icons__icons___XoCGh"></span>
                            <ul class="styles__row___aDusX">
                                <ul class="styles__row___aDusX">
                                    <li class="styles__item___3NYt8">
                                        <a class="styles__link___1Sj61" title="صفحه اصلی" href="/AkoladShop/">صفحه اصلی</a>
                                    </li>
                                    <li class="styles__item___3NYt8">
                                        <a class="styles__link___1Sj61" title="درباره ما" href="/AkoladShop/about">درباره ما</a>
                                    </li>
                                    <li class="styles__item___3NYt8">
                                        <a class="styles__link___1Sj61" title="تماس با ما" href="/AkoladShop/contact">تماس با ما</a>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                        <div class="styles__left-side___3VVDE">
                            <div class="styles__search-wrapper___aim8U">
                                <span class="icons__icon-search___37I3c icons__icons___XoCGh form__search-icon___2iMhO"></span>
                                <div class="form__input-wrapper___818qj">
                                    <span class="icons__icon-close___1FcTX icons__icons___XoCGh form__close-icon___1NTKj"></span>
                                    <div>
                                        <div class="form__control-wrapper___37Mo-">
                                            <input class="form__input___2Aozs" type="text" placeholder="نام محصول یا دسته" maxlength="30" value=""/>
                                        </div>
                                        <div class="button__btn-normal-regular___UvGoL button__btn-normal___299V7 button__btn___3Wejk button__regular___1Db91 form__search-button___2PH78 button__disabled___1bqMo"> جستجو</div>
                                    </div>
                                    <div class="form__dropdown___2MeXi"></div>
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] === "1") {
                            ?>
                            <div class="styles__mini-cart___1UF1D styles__mini-cart___2pwDY">
                                <div class="styles__inner___1ggnZ general__clear___2ZeHL">
                                    <a class="styles__link___3NfmG general__clear___2ZeHL" href="/AkoladShop/admin_products" title="مدیریت محصولات">
                                        <div class="styles__icon___-pzvd icons__icon-orders___2D_yX icons__icons___XoCGh"></div>
                                        <div class="styles__label___2h2iu">
                                            <span class="styles__label-text___3Gk-R">مدیریت محصولات</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>

                            <div class="styles__user-auth___3Mo1l">
                                <div class="styles__user-auth___24emv">
                                    <div> <?php if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
                                            echo('
                                            <script type="text/javascript">
                                                function check_logout() {
                                                   if (confirm("مطمئن هستید که میخواهید از سایت خارج شوید؟")) location.replace("/AkoladShop/logout");
                                                   }
                                               </script>
                                               <span class="styles__user-auth-link___1A98w">
                                                ( ' . $_SESSION["realname"] . ' )
                                                </span>
                                                <span class="styles__separator___367Mt">
                                                </span>
                                                    <a onclick="check_logout()">
                                                        <span class="styles__user-auth-link___1A98w">
                                                            خروج
                                                        </span>
                                                    </a>
                                                     ');
                                        } else {
                                            echo(' <a href="/AkoladShop/register"> <span class="styles__user-auth-link___1A98w"> عضویت </span> </a> <span class="styles__separator___367Mt"></span> <a href="/AkoladShop/login"> <span class="styles__user-auth-link___1A98w"> وارد شوید </span> </a> ');
                                        } ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
