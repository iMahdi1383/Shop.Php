<?php
session_start();
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] === "1")) {
    echo(' 
        <script type="text/javascript">
            location.replace("/AkoladShop/index.php");
        </script>
    ');
}

$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno()) exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
$query = " SELECT `pro_code` FROM `products` ";
$result = mysqli_query($link, $query);
$counter = 0;
$row_pro_code = [];
while ($row = mysqli_fetch_array($result)) {
    $row_pro_code[$counter] = $row[0];
    $counter++;
}
$new_pro_code = count($row_pro_code) + 1;


$query = 'SELECT * FROM `products`';
$result = mysqli_query($link, $query);


$url = $pro_code = $pro_name = $pro_qty = $pro_price = $pro_image = $pro_detail = "";
$btn_caption = "اضافه کردن محصول";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE pro_code='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($result)) {
        $new_pro_code = $pro_code = $row['pro_code'];
        $pro_name = $row['pro_name'];
        $pro_qty = $row['pro_qty'];
        $pro_price = $row['pro_price'];
        $pro_image = $row['pro_image'];
        $pro_detail = $row['pro_detail'];
        $url = "?id=$pro_code&action=EDIT";
        $btn_caption = "ويرايش محصول";
    }
}
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8"/>
    <title>فروشگاه آکولاد | مدیریت محصولات</title>
    <link rel="stylesheet" href="../_files/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
</head>
<body>
<script type="text/javascript">
    function check_add_product() {
        let pro_code, pro_name, pro_qty, pro_price;
        pro_code = document.getElementById("pro_code").value;
        pro_name = document.getElementById("pro_name").value;
        pro_qty = document.getElementById("pro_qty").value;
        pro_price = document.getElementById("pro_price").value;
        if (pro_code === "") alert("وارد کردن کد کالا الزامی است");
        else if (pro_name === "") alert("وارد کردن نام کالا الزامی است");
        else if (pro_qty === "") alert("وارد کردن موجودی کالا الزامی است");
        else if (pro_price === "") alert("وارد کردن قیمت کالا الزامی است");
        else if (confirm("از صحت اطلاعات وارد شده اطمینان دارید؟"))
            document.add_product.submit();
    }
</script>
<div class="modal__overlay-fixed-open___T89Rr modal__overlay-fixed___3Lxhl modal__overlay___3I1-i modal__fixed___2wzGG modal__open___1FXWL">
    <div class="modal__modal-wrapper___1cB-2">
        <div class="modal__modal-inner___35euL">
            <a href="javascript:history.go(-1)">
                <span class="modal__modal-close-fade-in___7klXv modal__modal-close___3JMip modal__animated___P-pr_ modal__fade-in___1OZxq icons__icon-close___1FcTX icons__icons___XoCGh">
                </span>
            </a>
            <div class="modal__modal-zoom-in___1sNJ0 modal__modal-normal___3V63Z modal__modal___3MuLY modal__animated___2wuup modal__zoom-in___2kmNx ">
                <div class=" modal__modal-content-wrapper___3dx0G">
                    <div class="modal__modal-body-normal___39UBo modal__modal-body___1Bef6">
                        <div>
                            <div>
                                <form name="add_product" action="action_admin_products.php<?php if (!empty($url)) echo($url); ?>" method="post"
                                      enctype="multipart/form-data">
                                    <div class="tabs__tabs-wrapper___21Qeu">
                                        <div class="tabs__tabs-label-list___9my3C">
                                            <div class="tabs__tab___3yXeU "
                                                 style="
                                                 <?php if (isset($_GET['action']) && $_GET['action'] == 'EDIT') { ?>
                                                         color: #d3974d;
                                                 <?php } else { ?>
                                                         color: #4dd397;
                                                 <?php } ?>
                                                         text-shadow: 0px 4px 20px;">
                                                <?php echo($btn_caption); ?>
                                            </div>
                                        </div>
                                        <div class="tabs__tab-panes-wrapper___2zA68">
                                            <div class="tabs__active-tab-pane___1DZgD tabs__tab-pane___325P_ ">
                                                <div class="tabs__tab-pane-inner___coXM3">
                                                    <div class="grid__container-12___2H10i grid__gap-large___2XaKw ">
                                                        <div class=" grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z">
                                                            <div>
                                                                <label for="pro_code"
                                                                       class="form__control-label___1W7Ga">
                                                                    کد کالا
                                                                </label>
                                                                <div class="select__select___3OdQe general__clear___2PciI">
                                                                    <div class="select__tags-overflow___3nfbu select__select-overflow___gi4xu">
                                                                        <div class="select__selected-tags-wrapper___389H3 select__selected-items-wrapper___Lpccf">
                                                                            <input id="pro_code"
                                                                                   name="pro_code"
                                                                                   type="text"
                                                                                   class="select__text-box___26W4P"
                                                                                   placeholder="کد کالا"
                                                                                   value="<?php echo($new_pro_code) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z">
                                                            <div>
                                                                <label for="pro_name"
                                                                       class="form__control-label___1W7Ga">
                                                                    نام کالا
                                                                </label>
                                                                <div class="select__select___3OdQe general__clear___2PciI">
                                                                    <div class="select__tags-overflow___3nfbu select__select-overflow___gi4xu">
                                                                        <div class="select__selected-tags-wrapper___389H3 select__selected-items-wrapper___Lpccf">
                                                                            <input id="pro_name"
                                                                                   name="pro_name"
                                                                                   type="text"
                                                                                   class="select__text-box___26W4P"
                                                                                   placeholder="نام کالا"
                                                                                   value="<?php echo($pro_name) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z">
                                                            <div>
                                                                <label for="pro_price"
                                                                       class="form__control-label___1W7Ga">
                                                                    قیمت کالا
                                                                </label>
                                                                <div class="select__select___3OdQe general__clear___2PciI">
                                                                    <div class="select__tags-overflow___3nfbu select__select-overflow___gi4xu">
                                                                        <div class="select__selected-tags-wrapper___389H3 select__selected-items-wrapper___Lpccf">
                                                                            <input id="pro_price"
                                                                                   name="pro_price"
                                                                                   type="text"
                                                                                   class="select__text-box___26W4P"
                                                                                   placeholder="قیمت کالا"
                                                                                   value="<?php echo($pro_price) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z">
                                                            <div>
                                                                <label for="pro_qty"
                                                                       class="form__control-label___1W7Ga">
                                                                    موجودی کالا
                                                                </label>
                                                                <div class="select__select___3OdQe general__clear___2PciI">
                                                                    <div class="select__tags-overflow___3nfbu select__select-overflow___gi4xu">
                                                                        <div class="select__selected-tags-wrapper___389H3 select__selected-items-wrapper___Lpccf">
                                                                            <input id="pro_qty"
                                                                                   name="pro_qty"
                                                                                   type="text"
                                                                                   class="select__text-box___26W4P"
                                                                                   placeholder="موجودی کالا"
                                                                                   value="<?php echo($pro_qty) ?>"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z"
                                                             style=" grid-column: span 3; ">
                                                            <div>

                                                                <label for="pro_image" class="form__control-label___1W7Ga" style="cursor: pointer;">
                                                                    <?php if (!empty($pro_image)) { ?>
                                                                        <img src="../_files/img/post/<?php echo($pro_image) ?>" alt="<?php echo($pro_name) ?>" style="width: 100%">
                                                                    <?php } ?>
                                                                    تصویر کالا
                                                                </label>
                                                                <div class="select__select___3OdQe general__clear___2PciI" style="cursor: pointer;">
                                                                    <div class="select__tags-overflow___3nfbu select__select-overflow___gi4xu">
                                                                        <div class="select__selected-tags-wrapper___389H3 select__selected-items-wrapper___Lpccf">
                                                                            <input id="pro_image"
                                                                                   name="pro_image"
                                                                                   type="file"
                                                                                   class="select__text-box___26W4P"
                                                                                   placeholder="تصویر کالا"
                                                                                   style="padding: 0 6px; cursor: pointer;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z"
                                                             style="grid-column: span 9;">
                                                            <div>
                                                                <label for="pro_detail"
                                                                       class="form__control-label___1W7Ga">
                                                                    توضیحات کالا
                                                                </label>
                                                                <div class="select__select___3OdQe general__clear___2PciI" style="height: auto;">
                                                                    <div class="select__tags-overflow___3nfbu select__select-overflow___gi4xu" style="height: auto;">
                                                                        <div class="select__selected-tags-wrapper___389H3 select__selected-items-wrapper___Lpccf" style="height: auto;">
                                                                            <textarea id="pro_detail"
                                                                                      name="pro_detail"
                                                                                      class="select__text-box___26W4P pro_detail"
                                                                                      placeholder="توضیحات کالا"><?php echo($pro_detail) ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if (empty($url)) { ?>
                                                            <div class="grid-table grid__span-6___1zdDW grid__span-small-12___3tjOV grid__relative___2hH1z">
                                                                <div>
                                                                    <table class="akolad-table">
                                                                        <thead>
                                                                        <tr>
                                                                            <td>كد كالا</td>
                                                                            <td>نام كالا</td>
                                                                            <td>موجودي كالا</td>
                                                                            <td>قيمت كالا</td>
                                                                            <td>تصوير كالا</td>
                                                                            <td>ابزار مديريتي</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo($row['pro_code']) ?></td>
                                                                                <td><?php echo($row['pro_name']) ?></td>
                                                                                <td><?php echo($row['pro_qty']) ?></td>
                                                                                <td><?php echo($row['pro_price']) ?>&nbsp; ريال</td>
                                                                                <td>
                                                                                    <img src="../_files/img/post/<?php echo($row['pro_image']) ?>">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="index.php?id=<?php echo($row['pro_code']) ?>&action=EDIT">ويرايش</a>
                                                                                    &nbsp;|&nbsp;
                                                                                    <a href="action_admin_products.php?id=<?php echo($row['pro_code']) ?>&action=DELETE">حذف</a>

                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        } //while
                                                                        ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal__modal-footer-normal___36J2s modal__modal-footer___2SNjy">
                        <a href="javascript:history.go(-1)"
                           class="button__btn-modal-normal-m-regular___2I7yO button__btn-modal-normal___1vV1o button__m-regular___168mR ">
                            انصراف
                        </a>
                        <style type="text/css">
                            .button__m-success___2qCL1:hover {
                            <?php if (isset($_GET['action']) && $_GET['action'] == 'EDIT') { ?>
                                background: #d3974d;
                            <?php } else { ?>
                                background: #4dd397;
                            <?php } ?>
                            }
                        </style>
                        <button type="button" onclick="check_add_product()" class="button__btn-modal-normal-m-success___3nFRx button__btn-modal-normal___1vV1o button__m-success___2qCL1 button__bold___1oty8">
                            <?php echo($btn_caption); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>