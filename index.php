<?php include("_files/component/header.php");
$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno()) exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
$query = " SELECT * FROM `products` ";
$result = mysqli_query($link, $query);
?>

<div class="styles__column-banners___3G-CS styles__margin-bottom___17yny">
    <div class="grid__container-12___3u-ry grid__gap___H3wvZ styles__inner___14PH- styles__same-height___M4A_9">
        <div
            class="styles__banner___ZkiPd styles__extra-large___gCs4m styles__hasHoverEffect___3Mlpv grid__span-12___1-3MT grid__span-small-12___PyHZy">
            <div class="styles__link___uAb93">
                <div>
                    <img src="_files/img/banner/1.jpg" class="styles__background-image___33nw8" alt="فروشگاه آکولاد" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="styles__container___3MHNV general__clear___2ZeHL">
    <div class="styles__title-wrapper___GQhuH">
        <h3 class="styles__title___Ri_k6">
            جدیدترین محصولات
        </h3>
    </div>
    <div class="grid__container-12___3u-ry grid__gap___H3wvZ styles__inner___5xPKL">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            if ($row["pro_qty"] > 0) {
                ?>
        <div class="styles__product___1LE7u grid__span-3___209ec grid__span-small-12___PyHZy">
            <a class="styles__link___2gWWU general__clear___2ZeHL" href="product/?id=<?php echo($row['pro_code']) ?>">
                <div class="styles__image-wrapper___2gOLc">
                    <div class="styles__image-align___2IfJO">
                        <img class="styles__image___1WTpz" src="_files/img/post/<?php echo($row["pro_image"]); ?>"
                            alt="<?php echo($row["pro_name"]); ?>" />
                    </div>
                </div>
                <h2 class="styles__title___1_uJX" dir="auto">
                    <?php echo($row["pro_name"]); ?>
                </h2>
                <div class="styles__info___2oc9q">
                    <div>
                        <span class="styles__price___rhYxO">
                            <?php echo($row["pro_price"]); ?>
                            <span>تومان</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php
mysqli_close($link);
include("_files/component/footer.php"); ?>