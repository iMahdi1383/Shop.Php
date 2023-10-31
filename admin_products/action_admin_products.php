<?php
session_start();
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] === "1")) {
    ?>
    <script type="text/javascript">
        location.replace("../index.php");
    </script>
    <?php
}

$uploadOk = 1;
$query = $pro_code = $pro_name = $pro_qty = $pro_price = $pro_image = $pro_detail = null;

if (!(isset($_GET['action']) && $_GET['action'] == 'DELETE')) {
    $pro_code = $_POST['pro_code'];
    $pro_name = $_POST['pro_name'];
    $pro_qty = $_POST['pro_qty'];
    $pro_price = $_POST['pro_price'];
    $pro_image = basename($_FILES["pro_image"]["name"]);
    $pro_detail = $_POST['pro_detail'];
}

$link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
if (mysqli_connect_errno())
    exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());

function rename_proimg($id){
    $link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
    if (mysqli_connect_errno())
        exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
    $query = "
                    SELECT
                        `pro_image`,
                        `pro_code`
                    FROM
                        `products`
                    WHERE
                        pro_code = '$id'
                ";
    $result = $link->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img_format = strtolower(pathinfo("../_files/img/post/" . $row['pro_image'], PATHINFO_EXTENSION));
            $query2 = "
                         UPDATE 
                             `products` 
                         SET 
                             `pro_image` = '{$row['pro_code']}.$img_format'
                         WHERE 
                               `pro_image` != 'null.png' AND 
                               `pro_code` = '{$row["pro_code"]}'
                       ";
            mysqli_query($link,$query2);
            rename("../_files/img/post/{$row['pro_image']}", "../_files/img/post/{$row['pro_code']}.$img_format");
        }
    }
}
function end_insertUpdate()
{
    $link = mysqli_connect("127.0.0.1", "root", "", "shop_db");
    if (mysqli_connect_errno())
        exit("خطایی به شرح زیر رخ داده است : " . mysqli_connect_error());
    $query = "
            UPDATE
                `products`
            SET
                `pro_image` = 'null.png'
            WHERE
                `pro_image` = ''
         ";
    mysqli_query($link, $query);
    $query = "
            SELECT
                `pro_image`,
                `pro_code`
            FROM
                `products`
            WHERE
                `pro_image` != 'null.png'
         ";
    $result = $link->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img_format = strtolower(pathinfo("../_files/img/post/" . $row['pro_image'], PATHINFO_EXTENSION));
            $query2 = "
                         UPDATE 
                             `products` 
                         SET 
                             `pro_image` = '{$row['pro_code']}.$img_format'
                         WHERE 
                               `pro_image` != 'null.png' AND 
                               `pro_code` = '{$row["pro_code"]}'
                       ";
            mysqli_query($link,$query2);
            rename("../_files/img/post/{$row['pro_image']}", "../_files/img/post/{$row['pro_code']}.$img_format");
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'DELETE') {

    $id = $_GET['id'];

    $query = "SELECT pro_image  FROM products
             WHERE pro_code='$id'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $pro_image = $row['pro_image'];

    $query = "DELETE  FROM products
             WHERE pro_code='$id'";

    if (mysqli_query($link, $query) === true) {
        echo("<p style='color:green;'><b>محصول انتخاب شده با موفقيت حذف شد</b></p>");
        unlink("../_files/img/post/" . $pro_image);
    } else
        echo("<p style='color:red;'><b>خطا در حذف محصول</b></p>");
    mysqli_close($link);
    exit();
}


if ($_FILES['pro_image']['error'] !== 4) {
    $target_dir = "../_files/img/post/";
    $target_file = $target_dir . basename($_FILES["pro_image"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    $check = getimagesize($_FILES["pro_image"]["tmp_name"]);
    if ($check !== false) {
        echo "پرونده انتخابی یک تصویر از نوع - " . $check["mime"] . " است  <br />";
        $uploadOk = 1;
    } else {
        echo "پرونده انتخاب شده یک تصویر نیست  <br />";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        if ($_GET['action']) {
            $id = $_GET['id'];
            $query = "
                    SELECT
                        `pro_image`,
                        `pro_code`
                    FROM
                        `products`
                    WHERE
                        pro_code = '$id'
                ";
        }
        $result = $link->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $img_format = strtolower(pathinfo("../_files/img/post/" . $row['pro_image'], PATHINFO_EXTENSION));
                $query2 = "
                         UPDATE 
                             `products` 
                         SET 
                             `pro_image` = '{$row['pro_code']}.$img_format'
                         WHERE 
                               `pro_image` != 'null.png' AND 
                               `pro_code` = '{$row["pro_code"]}'
                       ";
                mysqli_query($link,$query2);
                rename("../_files/img/post/{$row['pro_image']}", "../_files/img/post/{$row['pro_code']}.$img_format");
            }
        }
    }

    if ($_FILES["pro_image"]["size"] > (500 * 1024)) {
        echo "اندازه پرونده انتخابی بیشتر از 500 کیلوبایت است  <br />";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !=
        "jpeg") {
        echo "فقط پسوندهای JPG, JPEG, PNG & GIF برای پرونده مجاز هستند  <br />";
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        echo('پرونده انتخاب شده به سرویس دهنده میزبان ارسال نشد <br />');
    } else {
        if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {
            echo "پرونده " . basename($_FILES["pro_image"]["name"]) .
                " با موفقیت به سرویس دهنده میزبان انتقال یافت  <br />";
        } else {
            echo "خطا در ارسال پرونده به سرویس دهنده میزبان رخ داده است <br />";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    if ($_FILES['pro_image']['error'] === 4)
        $pro_image = "not changed";
    else {
        rename_proimg($id);
    }
    if ($pro_image === "not changed") {
        $query = "UPDATE products SET
             pro_code='$pro_code',
             pro_name='$pro_name',
             pro_qty='$pro_qty',
             pro_price='$pro_price',
             pro_detail='$pro_detail'
                         
             WHERE pro_code='$id'";
    } else {
        $query = "UPDATE products SET
             pro_code='$pro_code',
             pro_name='$pro_name',
             pro_qty='$pro_qty',
             pro_price='$pro_price',
             pro_image = '$pro_image',
             pro_detail='$pro_detail'
                         
             WHERE pro_code='$id'";
    }
    if (mysqli_query($link, $query) === true)
        echo("<p style='color:green;'><b>محصول انتخاب شده با موفقيت ويرايش شد</b></p>");
    else
        echo("<p style='color:red;'><b>خطا در ويرايش محصول</b></p>");

    if ($pro_image !== "not changed") end_insertUpdate();
    mysqli_close($link);
    exit();
}

if ($uploadOk == 1) {
    if ($_FILES['pro_image']['error'] === 4) $pro_image = "";
    $query = "INSERT INTO products 
    (pro_code,
     pro_name,
     pro_qty,
     pro_price,
     pro_image,
     pro_detail) VALUES
      ('$pro_code',
       '$pro_name',
       '$pro_qty',
       '$pro_price',
       '$pro_image',
       '$pro_detail')";

    if (mysqli_query($link, $query) === true)
        echo("<p style='color:green;'><b>کالا با موفقیت به انبار اضافه شد</b></p>");
    else
        echo("<p style='color:red;'><b>خطا در ثبت مشخصات کالا در انبار</b></p>");
} else
    echo("<p style='color:red;'><b>خطا در ثبت مشخصات کالا در انبار</b></p>");


end_insertUpdate();
mysqli_close($link);
?>
