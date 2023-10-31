<?php
include("../_files/component/header.php");
$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno()) exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
$pro_code = 0;
if (isset($_GET["id"]))
    $pro_code = $_GET["id"];
$query = " SELECT * FROM `products` WHERE `pro_code` = " . $pro_code;
$result = mysqli_query($link, $query);

if ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="styles__wrapper___5Gp-X general__clear___2ZeHL">
        <div class="styles__inner___19QZP">
            <div class="styles__slideshow___wQpvu">
                <div class="styles__title-wrapper-responsive___1cUa0">
                    <div class="styles__pre-title___1Diqh general__clear___2ZeHL">
                        <span class="styles__bread-crumb-item___3xa5Q styles__product-type___2ylfY">آکولاد</span>
                    </div>
                    <h1 class="styles__title___3F4_f">
                        <?php echo($row['pro_name']); ?>
                    </h1>
                </div>
                <div class="styles__product-images___1SB-y">
                    <div class="slick-slider styles__slideshow___Ja7tn slick-initialized">
                        <div class="slick-list">
                            <div class="slick-track" style="
                                                        width: 470px;
                                                        opacity: 1;
                                                        transform: translate3d(
                                                            0px,
                                                            0px,
                                                            0px
                                                        );
                                                    ">
                                <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1"
                                     aria-hidden="false" style="
                                                            outline: none;
                                                            width: 470px;
                                                        ">
                                    <div>
                                        <div class="styles__slide-wrapper___3uPex" tabindex="-1" style="
                                                                    width: 100%;
                                                                    display: inline-block;
                                                                ">
                                            <div class="styles__slide-inner___3K_U1">
                                                <img tabindex="0" src="../_files/img/post/<?php echo($row['pro_image']); ?>"
                                                     alt="<?php echo($row['pro_name']); ?>" class="styles__slide___1r6T7" style="cursor: zoom-in;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="styles__content___3qMBp">
                <div class="styles__title-wrapper___veOg1">
                    <div class="styles__pre-title___1Diqh general__clear___2ZeHL">
                        <span class="styles__bread-crumb-item___3xa5Q styles__product-type___2ylfY">آکولاد</span>
                        <div class="styles__bread-crumb___3SQ2u">
                            <a class="styles__bread-crumb-item___3xa5Q" href="../">صفحه اصلی</a>
                            <span class="styles__slash___1Q8vm"></span>
                            <a class="styles__bread-crumb-item___3xa5Q" href="#">
                                <?php echo($row['pro_name']); ?>
                            </a>
                        </div>
                    </div>
                    <h1 data-product="title" class="styles__title___3F4_f">
                        <?php echo($row['pro_name']); ?>
                    </h1>
                </div>
                <div class="styles__prices___2r-2x">
                    <span data-product="price" class="styles__final-price___1L1AM">
                        <?php echo($row['pro_price']); ?>
                        <span class="styles__currency___3GGwS">
                            تومان
                        </span>
                    </span>
                </div>
                <?php
                if ($row['pro_qty'] > 0) {
                    ?>
                    <div>
                        <div class="styles__options___1hp3B general__clear___2ZeHL">
                        </div>
                        <div class="styles__cta-wrapper___1njoU">
                            <div class="styles__button-wrapper___tIUZJ">
                                <a href="../order/?id=<?php echo($row['pro_code']); ?>">
                                    <div class="button__btn-normal-success___1JY6- button__btn-normal___299V7 button__btn___3Wejk button__success___2V0M8 styles__buy-button___11qld"
                                         data-product="buyButton">
                                        خرید محصول
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div>
                        <div class="styles__options___1hp3B general__clear___2ZeHL">
                        </div>
                        <div class="styles__cta-wrapper___1njoU">
                            <div class="styles__button-wrapper___tIUZJ">
                                <div class="button__btn-normal-success___1JY6- button__btn-normal___299V7 button__btn___3Wejk button__success___2V0M8 styles__buy-button___11qld button__disabled___1bqMo">
                                    متاسفانه موجودی این کالا به اتمام رسیده است
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="styles__description___3dh1f" data-product="description">
                    <pre><?php echo($row['pro_detail']); ?></pre>
                </div>
            </div>
        </div>
    </div>
    <?php
}
mysqli_close($link);
include("../_files/component/footer.php"); ?>