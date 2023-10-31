<?php
session_start();
$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno()) exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
$pro_code = 0;
if (isset($_GET['id']))
    $pro_code = $_GET['id'];
else {
    echo('
    <script type="text/javascript">
        location.replace("../");
    </script>
    ');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>آکولاد | خرید محصول</title>
    <link rel="stylesheet" href="/AkoladShop/_files/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
</head>
<body class="store-body">
<?php
if (!(isset($_SESSION['state_login']) && $_SESSION['state_login'] == true)) {
    ?>
    <div class="modal__overlay-fixed-open___T89Rr modal__overlay-fixed___3Lxhl modal__overlay___3I1-i modal__fixed___2wzGG modal__open___1FXWL">
        <div class="modal__modal-wrapper___1cB-2">
            <div class="modal__modal-inner___35euL">
                <a href="javascript:history.go(-1)">
                    <span class="modal__modal-close-fade-in___7klXv modal__modal-close___3JMip modal__animated___P-pr_ modal__fade-in___1OZxq icons__icon-close___1FcTX icons__icons___XoCGh">
                    </span>
                </a>
                <div class="modal__modal-zoom-in___3o_8X modal__modal-normal___xAhLb modal__modal___fG-9Z modal__animated___P-pr_ modal__zoom-in___1G3GS">
                    <div class="modal__modal-content___2gLRe">

                        <div class="styles__title___3RZ4b">
                            ابتدا باید وارد شوید.
                        </div>

                        <div class="modal__modal-footer___1wfo3" style="line-height: 160%">
                            برای خرید محصول ابتدا باید با نام کاربری و رمز عبور خود وارد سایت شوید
                        </div>
                        <br>
                        <br>
                        <a href="../login/">
                            <button type="button" class="button__btn-normal-success___1JY6- button__btn-normal___299V7 button__btn___3Wejk button__success___2V0M8 styles__button___285We">
                                ورود به حساب کاربری
                            </button>
                        </a>
                        <div class="modal__modal-footer___1wfo3">
                            کاربر جدید هستید؟ همین حالا
                            <a href="../register">
                                <span class="styles__link___3uu51">
                                    ثبت نام
                                </span>
                            </a>
                            کنید!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    $query = "
         SELECT *
         FROM `products`
         WHERE pro_code = '$pro_code' 
         ";

    $result = mysqli_query($link, $query);
    ?>
    <div id="root">
        <div class="styles__empty___3WCoC"></div>
        <div class="general__wrapper___124c8">
            <div class="general__checkout___3xFSh">
                <div class="styles__steps___3inVP">
                    <div class="styles__step___2XbbQ styles__active___3yAGE">
                        <div class="styles__inner___2QoQr">
                            <span class="icons__icon-online-shop___1gqms icons__icons___XoCGh styles__icon___19fxg"></span>
                            <h3 class="styles__title___1v1NM styles__active-title___3I38E">اطلاعات ارسال</h3>
                        </div>
                    </div>

                    <div class="styles__step___2XbbQ ">
                        <div class="styles__line___421yS "></div>
                        <div class="styles__inner___2QoQr">
                            <span class="icons__icon-wallet___2JlaZ icons__icons___XoCGh styles__icon___19fxg"></span>
                            <h3 class="styles__title___1v1NM ">درگاه پرداخت</h3>
                        </div>
                    </div>
                    <div class="styles__step___2XbbQ ">
                        <div class="styles__line___421yS "></div>
                        <div class="styles__inner___2QoQr">
                            <span class="icons__icon-checked___3uvbO icons__icons___XoCGh styles__icon___19fxg"></span>
                            <h3 class="styles__title___1v1NM ">پایان خرید</h3>
                        </div>
                    </div>
                </div>

                <?php
                $username = $_SESSION['username'];
                $query = "
                         SELECT `realname`, `email`
                         FROM `users`
                         WHERE username = '$username'
                         ";

                $user_result = mysqli_query($link, $query);
                $user_row = mysqli_fetch_array(mysqli_query($link, $query));
                ?>

                <div class="styles__section___1Jsp0">
                    <div class="styles__shipping-inner___1-VyE general__clear___2ZeHL">
                        <form action="action_order.php" method="post" name="order">
                            <div class="styles__shipping-wrapper___1LUPz general__clear___2ZeHL">
                                <div class="styles__left-side___mcud3">
                                    <div>
                                        <div class="form__control-row___j5KzW general__clear___2ZeHL">
                                            <div class=" form__control-wrapper-col-2___9T2rq grid__col-2___1ewZo form__control-wrapper___37Mo-  ">
                                                <label for="firstname" class="form__control-label___2uIEw ">نام تحویل گیرنده</label>
                                                <input name="firstname" class="form__text-box___3esxj " id="firstname" type="text" placeholder="" value="<?php echo($user_row['realname']) ?>">
                                            </div>
                                            <div class=" form__control-wrapper-col-2___9T2rq grid__col-2___1ewZo form__control-wrapper___37Mo-  ">
                                                <label for="lastname" class="form__control-label___2uIEw ">نام خانوادگی تحویل گیرنده</label>
                                                <input name="lastname" class="form__text-box___3esxj" id="lastname" type="text" placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="form__control-row___j5KzW general__clear___2ZeHL">
                                            <div class=" form__control-wrapper-col-2___9T2rq grid__col-2___1ewZo form__control-wrapper___37Mo-  ">
                                                <label for="mobile" class="form__control-label___2uIEw ">شماره موبایل</label>
                                                <input name="mobile" class="form__text-box___3esxj  form__ltr___2HdeQ" id="mobile" type="text" maxlength="11" placeholder="" value="">
                                            </div>
                                            <div class=" form__control-wrapper-col-2___9T2rq grid__col-2___1ewZo form__control-wrapper___37Mo-  ">
                                                <label for="email" class="form__control-label___2uIEw ">ایمیل</label>
                                                <input name="email" class="form__text-box___3esxj  form__ltr___2HdeQ  " id="email" type="email" placeholder="" value="<?php echo($user_row['email']) ?>">
                                            </div>
                                        </div>
                                        <div class="form__control-row___j5KzW general__clear___2ZeHL">
                                            <div class=" form__control-wrapper-col-1___20ttG form__control-wrapper___37Mo-  ">
                                                <label for="address" class="form__control-label___2uIEw ">آدرس پستی</label>
                                                <input name="address" class="form__text-box___3esxj" id="address" type="text" placeholder="آدرس دقیق پستی به همراه کد پستی" value="">
                                            </div>
                                        </div>
                                        <div class="form__control-row___j5KzW general__clear___2ZeHL">
                                            <div class=" form__control-wrapper-col-1___20ttG form__control-wrapper___37Mo-  " style="margin-bottom: 5px;">
                                                <label for="detail" class="form__control-label___2uIEw ">توضیحات (اختیاری)</label>
                                                <input name="detail" class="form__text-box___3esxj" id="detail" type="text" maxlength="200" placeholder="توضیحی که نیاز است در رابطه با سفارش بیان کنید" value="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="styles__right-side___OKHhc">
                                    <div class="styles__products-list___TSgmy">
                                        <?php
                                        if ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <input type="text" name="pro_code" id="pro_code" value="<?php echo($pro_code); ?>" style="display: none;">
                                            <input type="text" name="pro_name" id="pro_name" value="<?php echo($row["pro_name"]); ?>" style="display: none;">
                                            <input type="text" name="pro_price" id="pro_price" value="<?php echo($row["pro_price"]); ?>" style="display: none;">
                                            <input type="text" name="realname" id="realname" value="<?php echo($user_row['realname']); ?>" style="display: none;">
                                            <input type="text" name="all_price" id="all_price" value="0" style="display: none;">

                                            <div class="styles__product___1s7j1">
                                                <div class="styles__image-wrapper___JeLHF">
                                                    <span class="styles__count___3vZ4w" id="count_near_img">1</span>
                                                    <img class="styles__image___2Xhb_" src="../_files/img/post/<?php echo($row["pro_image"]) ?> " alt="<?php echo($row["pro_name"]) ?>">
                                                </div>
                                                <div class="styles__info___2GnEF">
                                                    <div class="styles__info-row___1m-pp">
                                                        <div class="styles__text___cPEp8">
                                                            <h4 class="styles__title___2MznQ"><?php echo($row["pro_name"]) ?></h4>
                                                            <div class="styles__variants-wrapper___anIdx" style="margin-top: 7px;">
                                                                <span class="styles__variant___3soda">
                                                                    <?php
                                                                    if (strlen($row["pro_detail"]) > 38)
                                                                        echo(substr($row["pro_detail"], 0, 35) . "...");
                                                                    else
                                                                        echo($row["pro_detail"]);
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="styles__price___32yZ5"><?php echo($row["pro_price"]) ?> تومان</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="styles__discount-code-wrapper___1otsf">
                                        <div class="styles__control-row___cmwsD">
                                            <div class=" form__control-wrapper___37Mo-  ">
                                                <input name="pro_qty" class="form__text-box___3esxj" id="pro_qty" type="text" maxlength="3" placeholder="تعداد کالا" onchange="calc_price();">
                                            </div>
                                            <button type="button" id="count_price" onclick="calc_price()" class="button__btn-normal-regular___UvGoL button__btn-normal___299V7 button__btn___3Wejk button__regular___1Db91  styles__discount-button___2xJxP">محاسبه قیمت</button>
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        function calc_price() {
                                            let pro_qty = <?php echo($row["pro_qty"])?>;
                                            let price = <?php echo($row["pro_price"])?>;
                                            let count = document.getElementById("pro_qty").value;
                                            let total_price;
                                            if (count > pro_qty) {
                                                alert("متاسفانه تعداد موجودی کالا از تعداد درخواستی شما کمتر است");
                                                document.getElementById("pro_qty").value = "";
                                                count = 0;
                                                document.getElementById("pro_qty").focus();
                                            }
                                            if (count === 0 || count === "")
                                                total_price = 0;
                                            else {
                                                total_price = count * price;
                                                document.getElementById('count_near_img').innerHTML = count.toString();
                                            }
                                            document.getElementById("total_price").innerHTML = total_price + " تومان";
                                            document.getElementById("pay_price").innerHTML = (total_price + 12000) + " تومان";
                                            document.getElementById("all_price").value = "" + (total_price + 12000);
                                        }
                                    </script>
                                    <div class="false styles__costs-wrapper___IRITC general__clear___2ZeHL ">
                                        <div class="styles__inner___1Gu4B ">
                                            <div class="styles__row___24L1s general__clear___2ZeHL">
                                                <div class="styles__caption___2nqmQ ">مبلغ کل سبد خرید:</div>
                                                <div class="styles__value___ARJqe " id="total_price">0 تومان</div>
                                            </div>
                                            <div class="styles__row___24L1s general__clear___2ZeHL">
                                                <div class="styles__caption___2nqmQ ">هزینه ارسال:</div>
                                                <div class="styles__value___ARJqe ">12000 تومان</div>
                                            </div>
                                            <div class="styles__main-row___3rdqQ general__clear___2ZeHL">
                                                <div class="styles__caption___2nqmQ">مبلغ قابل پرداخت:</div>
                                                <div class="styles__value___ARJqe styles__bold___Rr6BG" id="pay_price">12000 تومان</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="styles__navigation___3f7t9 general__clear___2ZeHL">
                    <div class="styles__inner___1p3tQ">
                        <div class="styles__left-side___hEl2d">
                            <button type="button" class="button__btn-normal-regular___UvGoL button__btn-normal___299V7 button__btn___3Wejk button__regular___1Db91  styles__button___32cKb" onclick="check_input()">
                                <span class="button__btn-icon-normal___2dkGJ button__btn-icon___qit0F button__btn-icon-left___2DSH8 icons__icon-arrow-drop-left___1lo1e icons__icons___XoCGh styles__button-icon___3GkrU"></span>
                                پرداخت اینترنتی
                            </button>
                        </div>
                        <script type="text/javascript">
                            function validateEmail(email) {
                                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                return re.test(String(email).toLowerCase());
                            }

                            function check_input() {
                                let count, mobile, email, address;
                                count = document.getElementById('pro_qty').value;
                                mobile = document.getElementById('mobile').value;
                                email = document.getElementById('email').value;
                                address = document.getElementById('address').value;
                                if (count == 0 || count === "") alert("تعداد کالا وارد نشده است");
                                else if (!validateEmail(email)) alert("ایمیل به درستی وارد نشده است");
                                else if (mobile.length !== 11 || mobile[0] !== '0' || mobile[1] !== '9') alert("شماره موبایل به درستی وارد نشده است");
                                else if (address.length < 15) alert("لطفا آدرس دقیق پستی خود را به همراه کد پستی وارد کنید");
                                else document.order.submit();

                            }
                        </script>
                        <a href="javascript:history.go(-1)">
                            <div class="styles__right-side___31dYp">
                                <div class="button__btn-normal-white___27Dz- button__btn-normal___299V7 button__btn___3Wejk button__white___AzclV  styles__button___32cKb ">
                                    <span class="button__btn-icon-normal___2dkGJ button__btn-icon___qit0F  icons__icon-arrow-drop-right___1w49K icons__icons___XoCGh styles__button-icon___3GkrU"></span>
                                    توضیحات محصول
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="styles__footer___1k3H8">
                <div class="styles__inner___2n55R">
                    <div class="styles__copyright___XBc0Q">
                        کدنویسی بک اند توسط:
                        <a class="styles__copyright-link___DpIL4" href="https://iakolad.ir" title="مهدی عسکرپور" target="_blank">آکولاد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
}
?>
</body>
</html>