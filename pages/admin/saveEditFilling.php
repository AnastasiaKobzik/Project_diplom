<?php
include "../../db/dbConnect.php";

$descr = $_POST['descr'];
$nameFill = $_POST['nameFill'];
$idFill = $_POST['idFill'];

// Название <input type="file">
$input_name = 'file';
$input_nameM = 'filem';
// Разрешенные расширения файлов.
$allow = array();
// Запрещенные расширения файлов.
$deny = array(
    'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
    'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
    'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
);
$error = $success = '';

if($descr!=null && $nameFill!=null){
    //Если большое и мал-ое фото не загружено
    if (!isset($_FILES[$input_name]) && !isset($_FILES[$input_nameM])) {
        $query = "UPDATE filling SET filling='$nameFill', description='$descr' WHERE id_filling = '$idFill'";
        $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
        if ($result) {
            $success = "<p>Изменения сохранены</p>";
        } else {
            $error = 'Не удалось загрузить файлы.';
        }
    //Если большое загружено, а мал-ое фото не загружено
    }elseif(isset($_FILES[$input_name]) && !isset($_FILES[$input_nameM])) {
        $file = $_FILES[$input_name];
             
        // Проверим на ошибки загрузки.
        if (!empty($file['error']) || empty($file['tmp_name'])) {
            $error = 'Не удалось загрузить Большой файл.';
        } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
            $error = 'Не удалось загрузить Большой файл.';
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
                $query = "UPDATE filling SET filling='$nameFill', description='$descr', photo='$img' WHERE id_filling = '$idFill'";
                $result=mysqli_query($dbLink, $query);
                if ($result) {
                    $success = "<p>Изменения сохранены</p>";
                } else {
                    $error = 'Не удалось загрузить файл.'.mysqli_error($dbLink);
                }
            }
        }
    //Если большое не загружено, а мал-ое фото загружено
    }elseif(!isset($_FILES[$input_name])&&isset($_FILES[$input_nameM])){
        $file = $_FILES[$input_nameM];
             
        // Проверим на ошибки загрузки.
        if (!empty($file['error']) || empty($file['tmp_name'])) {
            $error = 'Не удалось загрузить Маленький файл.';
        } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
            $error = 'Не удалось загрузить Маленький файл.';
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
                $img = addslashes(file_get_contents($_FILES['filem']['tmp_name']));
                $query = "UPDATE filling SET filling='$nameFill', description='$descr', photo_mini='$img' WHERE id_filling = '$idFill'";
                $result=mysqli_query($dbLink, $query);
                if ($result) {
                    $success = "<p>Изменения сохранены</p>";
                } else {
                    $error = 'Не удалось загрузить файл.'.mysqli_error($dbLink);
                }
            }
        }
    //Если большое загружено и мал-ое фото загружено
    }elseif(isset($_FILES[$input_name]) && isset($_FILES[$input_nameM])){
        $file = $_FILES[$input_name];
        $fileM = $_FILES[$input_nameM];
             
        // Проверим на ошибки загрузки.
        if (!empty($file['error']) || empty($file['tmp_name']) || !empty($fileM['error']) || empty($fileM['tmp_name'])) {
            $error = 'Не удалось загрузить файл.';
        } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name']) || $fileM['tmp_name'] == 'none' || !is_uploaded_file($fileM['tmp_name'])) {
            $error = 'Не удалось загрузить файл.';
        } else {
            // Оставляем в имени файла только буквы, цифры и некоторые символы.
            $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";

            $name = mb_eregi_replace($pattern, '-', $file['name']);
            $name = mb_ereg_replace('[-]+', '-', $name);
            $parts = pathinfo($name);

            $nameM = mb_eregi_replace($pattern, '-', $fileM['name']);
            $nameM = mb_ereg_replace('[-]+', '-', $nameM);
            $partsM = pathinfo($nameM);
             
            if (empty($name) || empty($parts['extension']) || empty($nameM) || empty($partsM['extension'])) {
                $error = 'Недопустимый тип файла';
            } elseif ((!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) || (!empty($allow) && !in_array(strtolower($partsM['extension']), $allow))) {
                $error = 'Недопустимый тип файла';
            } elseif ((!empty($deny) && in_array(strtolower($parts['extension']), $deny)) || (!empty($deny) && in_array(strtolower($partsM['extension']), $deny))) {
                $error = 'Недопустимый тип файла';
            } else {
                $img = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $imgM = addslashes(file_get_contents($_FILES['filem']['tmp_name']));
                $query = "UPDATE filling SET filling='$nameFill', description='$descr', photo='$img', photo_mini='$imgM' WHERE id_filling = '$idFill'";
                $result=mysqli_query($dbLink, $query);
                if ($result) {
                    $success = "<p>Изменения сохранены</p>";
                } else {
                    $error = 'Не удалось загрузить файл.'.mysqli_error($dbLink);
                }
            }
        }
    }
    
}else{
   $error = "Не все данные введены"; 
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