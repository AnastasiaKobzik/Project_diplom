<?php
include "../../db/dbConnect.php";

$nameProduct = $_POST['nameProduct'];
$descr = $_POST['descr'];
$price = $_POST['price'];
$weight = $_POST['weight'];
$category = $_POST['category'];
$form = $_POST['form'];
$filling = $_POST['filling'];

$weightRegEx = "/^[0-9.]{1,5}$/";
$priceRegEx = "/^[0-9.]{1,3}$/";

// Название <input type="file">
$input_name = 'file';
// Разрешенные расширения файлов.
$allow = array();
// Запрещенные расширения файлов.
$deny = array(
    'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
    'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
    'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
);
$error = $success = '';

if($nameProduct!=null && $descr!=null && $price!=null){
    
        if ($price!=0 && preg_match($priceRegEx, $price)){
            $img_type = substr($_FILES['img_upload']['type'], 0, 5);
            $img_size = 2*1024*1024;
            if (!isset($_FILES[$input_name])) {
                $error = 'Фото не загружено';
            }else {
                $file = $_FILES[$input_name];
             
                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл.';
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл.';
                } else {
                    // Оставляем в имени файла только буквы, цифры и некоторые символы.
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = mb_eregi_replace($pattern, '-', $file['name']);
                    $name = mb_ereg_replace('[-]+', '-', $name);
                    $parts = pathinfo($name);
             
                    if (empty($name) || empty($parts['extension'])) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = 'Недопустимый тип файла';
                    } else {
                        $img = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                        if ($form != null && $filling !=null) {
                            $query = "INSERT INTO product(name, description, photo, price, id_category, id_form, id_filling, weight, quantity) VALUES('$nameProduct','$descr','$img','$price','$category','$form','$filling','1', 1)";
                            $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
                            if ($result) {
                                $success = "<p style='text-align: center;'>Товар добавлен в каталог</p>";
                            } else {
                                $error = 'Не удалось загрузить файл.';
                            }
                        }else{
                            if ($weight!=null) {
                                if ($weight!=0 && preg_match($weightRegEx, $weight)) {
                                    $query = "INSERT INTO product(name, description, photo, price, id_category, id_form, id_filling, weight, quantity) VALUES('$nameProduct','$descr','$img','$price','$category',null,null,'$weight', '1')";
                                    $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
                                    if ($result) {
                                        $success = "<p style='text-align: center;' class='success'>Товар добавлен в каталог</p>";
                                    } else {
                                        $error = 'Не удалось загрузить файл.';
                                    }
                                }else{
                                    $error = "Неправильно введен вес";
                                }
                            }else $error = "Введите вес";
                        }
                    }
                }
            }
        }else{
            $error = "Неправильно введена цена";             
        }

    
    
}else{
   $error = "Заполните все поля"; 
}

 
$data = array(
    'error'   => $error,
    'success' => $success,
);
 
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);
exit();


mysqli_close($dbLink);
?>