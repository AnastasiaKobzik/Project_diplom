<?php
include "../../db/dbConnect.php";

$idProduct = $_POST['idProduct'];
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
            //если фото не заргужено
            if (!isset($_FILES[$input_name])) {
                if ($form != null && $filling !=null) {
                    $queryChange = "UPDATE product SET name='$nameProduct', description='$descr', price='$price', id_category='$category', id_form='$form', id_filling='$filling', weight='1' WHERE id_product = '$idProduct'";  
                    $resultChange = mysqli_query($dbLink, $queryChange);
                    if ($resultChange){
                        $success = "j";
                    }else {
                        $error = 'Не удалось добавить в бд: '.mysqli_error($dbLink);
                    }

                }else{
                    if ($weight!=null) {
                        if (preg_match($weightRegEx, $weight)) {
                            $queryChange = "UPDATE product SET name='$nameProduct', description='$descr', price='$price', id_category='$category', weight='$weight' WHERE id_product = '$idProduct'";  
                            $resultChange = mysqli_query($dbLink, $queryChange);
                            if ($resultChange){
                                $success = "j";
                            }else {
                                $error = 'Не удалось добавить в бд: '.mysqli_error($dbLink);
                            }
                        }else{
                            $error = "Неправильно введен вес";
                        }
                    }else $error = "Введите вес";
                }
            //если фото загружено
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
                            $queryChange = "UPDATE product SET name='$nameProduct', description='$descr', photo='$img', price='$price', id_category='$category', id_form='$form', id_filling='$filling', weight='1' WHERE id_product = '$idProduct'";  
                            $resultChange = mysqli_query($dbLink, $queryChange);
                            if ($resultChange){
                                $success = "j";
                            }else {
                                $error = 'Не удалось добавить в бд: '.mysqli_error($dbLink);
                            }
                        }else{
                            if ($weight!=null) {
                                if ($weight!=0 && preg_match($weightRegEx, $weight)) {
                                    $queryChange = "UPDATE product SET name='$nameProduct', description='$descr', photo='$img', price='$price', id_category='$category', weight='$weight' WHERE id_product = '$idProduct'";
                                    $resultChange = mysqli_query($dbLink, $queryChange);
                                    if ($resultChange){
                                        $success = "j";
                                    }else {
                                        $error = 'Не удалось добавить в бд: '.mysqli_error($dbLink);
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