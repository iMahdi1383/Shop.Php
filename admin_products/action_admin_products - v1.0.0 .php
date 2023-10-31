<?php
session_start();
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] === "1")) {
    echo(' 
        <script type="text/javascript">
            location.replace("/shop/index.php");
        </script>
    ');
}



$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno())
    exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());




$target_dir = "../_files/img/post/";
$pro_image = "";
$uploadOk = null;

if ($_FILES['pro_image']['error'] === 4) {
    $uploadOk = null;
    if (isset($_GET['action'])) {
        $id = $_GET['id'];
        $query = "
                SELECT
                    `pro_image`
                FROM
                    `products`
                WHERE
                    `pro_code` = '$id';
             ";
        $result = $link->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pro_image = $row['pro_image'];
            }
        }
    } else {
        $uploadOk = -1;
    }
} else if ($_FILES['pro_image']['error'] === 0) {
    $pro_code = $_POST["pro_code"];
    $pro_name = $_POST["pro_name"];
    $pro_qty = $_POST["pro_qty"];
    $pro_price = $_POST["pro_price"];
    $pro_detail = $_POST["pro_detail"];

    $_FILES["pro_image"]["name"] = $_POST["pro_code"] . "." . strtolower(pathinfo($target_dir . $_FILES["pro_image"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $_FILES["pro_image"]["name"];
    $pro_image = $_FILES["pro_image"]["name"];
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["pro_image"]["tmp_name"]);
    if ($check !== false) {
        echo("پرونده انتخابی یک تصویر از نوع {$check['mime']} است.<br>");
    } else {
        echo("پرونده انتخابی یک تصویر نیست<br>");
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        if (isset($_GET['action'])) {
            /* inja */
            if (file_exists("../_files/img/post/$pro_code.png"))
                unlink("../_files/img/post/$pro_code.png");
            if (file_exists("../_files/img/post/$pro_code.jpg"))
                unlink("../_files/img/post/$pro_code.jpg");
            if (file_exists("../_files/img/post/$pro_code.jpeg"))
                unlink("../_files/img/post/$pro_code.jpeg");
        } else {
            echo("کد محصول تکراری است.<br>");
            $uploadOk = 0;
        }
    }
    if ($_FILES["pro_image"]["size"] > (1024 * 1024)) {
        echo("اندازه پرونده انتخابی بیشتر از 1 مگابایت (1024 کیلوبایت) است<br>");
        $uploadOk = 0;
    }
    $imageFileType = strtolower($imageFileType);
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo("فقط پسوند های jpg,png,jpeg مجاز هستند.<br>");
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo("پرونده انتخاب شده به سرور ارسال نشد.<br>");
    } else {
        if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {
            echo("پرونده {$_FILES['pro_image']['name']} با موفقیت به سرور انتقال یافت.<br>");
        } else {
            echo("خطایی در ارسال پرونده به سرور رخ داده است<br>");
        }
    }
} else {
    $pro_code = $_POST["pro_code"];
    $pro_name = $_POST["pro_name"];
    $pro_qty = $_POST["pro_qty"];
    $pro_price = $_POST["pro_price"];
    $pro_detail = $_POST["pro_detail"];

    $uploadOk = -1;
}

if (isset($_GET['action'])) {
    $id = $_GET['id'];
    switch ($_GET['action']) {
        case 'EDIT':
            $pro_code = $_POST["pro_code"];
            $pro_name = $_POST["pro_name"];
            $pro_qty = $_POST["pro_qty"];
            $pro_price = $_POST["pro_price"];
            $pro_detail = $_POST["pro_detail"];
            $query = "
                        UPDATE
                            `products`
                        SET
                            `pro_code` = '$pro_code',
                            `pro_name` = '$pro_name',
                            `pro_qty` = '$pro_qty',
                            `pro_image` = '$pro_image',
                            `pro_price` = '$pro_price',
                            `pro_detail` = '$pro_detail'
                        WHERE
                            `pro_code` = '$id'
                    ";
            if (mysqli_query($link, $query) === true) { ?>
                <p style='color:green;'>
                    <b>محصول مورد نظر با موفقیت ویرایش شد</b>
                </p>
            <?php } else { ?>
                <p style='color:red;'>
                    <b>خطا در ویرایش محصول</b>
                </p>
                <?php
            }
            break;

        case 'DELETE' :
            $query = "
                        DELETE
                        FROM
                            `products`
                        WHERE
                            `pro_code` = '$id'
                    ";
            if (mysqli_query($link, $query) === true) { ?>
                <p style='color:green;'>
                    <b>محصول مورد نظر با موفقیت حذف شد</b>
                </p>
            <?php } else { ?>
                <p style='color:red;'>
                    <b>خطا در حذف محصول</b>
                </p>
                <?php
            }
            break;
    }
    $query = "
            UPDATE
                `products`
            SET
                `pro_image` = 'null.png'
            WHERE
                `pro_image` = ''
         ";
    mysqli_query($link,$query);
    mysqli_close($link);
    exit();
}


if ($uploadOk == -1 || $uploadOk == 1) {
    $pro_code = $_POST["pro_code"];
    $pro_name = $_POST["pro_name"];
    $pro_qty = $_POST["pro_qty"];
    $pro_price = $_POST["pro_price"];
    $pro_detail = $_POST["pro_detail"];
    if ($uploadOk == -1) $pro_image = "";
    $query = "
        INSERT INTO products (
            pro_code,
            pro_name,
            pro_qty,
            pro_price,
            pro_image,
            pro_detail
            )
             VALUES(
            '$pro_code',
            '$pro_name',
            '$pro_qty',
            '$pro_price',
            '$pro_image',
            '$pro_detail'
            );
            ";

    if (mysqli_query($link, $query) === true)
        echo("<p style='color:green;'><b>کالا با موفقیت به پایگاه داده اضافه شد</b></p>");
    else
        echo("<p style='color:red;'><b>خطا در ثبت مشخصات کالا در پایگاه داده</b></p>");
} else
    echo("<p style='color:red;'><b>خطا در ثبت تصویر کالا در پایگاه داده</b></p>");

$query = "
            UPDATE
                `products`
            SET
                `pro_image` = 'null.png'
            WHERE
                `pro_image` = ''
         ";
mysqli_query($link,$query);

mysqli_close($link);
?>
