<?php

require_once 'initialize.php';
function redirect_to($location)
{
    if ($location) {
        header("location: $location");
        exit;
    }
}


//function isLoggedIn()
//{
//    if (isset($_SESSION['id'])) {
//        $result = true;
//    } else {
//        $result = false;
//    }
//    return $result;
//}
//
//
//
//function loginFailed(){
//    if (isset($_GET['fail'])) {
//        echo <<<HTML
//<script>
//alert('Login Failed! Try Again');
//window.location='index.php';
//</script>
//HTML;
//
//    }
//    else{
//        return;
//    }
//}


function isRegistering()
{
    if (isset($_GET['name'])) {
        $temp = $_GET['name'];
        return $temp;
    }
    exit;
}

//function isAdmin()
//{
//    $role = null;
//    if (isset($_SESSION['role'])) {
//        if ($_SESSION['role'] == 'admin') {
//            $role = true;
//        } else {
//            $role = false;
//        }
//
//    }
//    return $role;
//}

/**
 * Function to save Images 'posted'
 * @param $owner
 * possible values : 'users' | 'events'
 * @param $input_name
 * possible values : 'image' | 'photo'
 * @return bool|string
 */
function saveImage($owner,$input_name)
{
    $file_name = $_FILES[$input_name]['name'];
    if ($file_name!='') {

        $file_name = $_FILES[$input_name]['name'];
        $arr_name = explode('.', $file_name);
        $ext = $arr_name[1];

        $source = $_FILES[$input_name]['tmp_name'];
        $trail = "$owner/". md5($file_name) . '.' . $ext;
        $destination = IMAGES . $trail;
        move_uploaded_file($source, $destination);
        $result = $trail;
    } else {
        $result = null;
    }
    return $result;
}

function displayImage($image){
    if (!empty($image)){
        $image='<a href=./assets/images/'.$image.'>Link</a>';
    }else{
        $image ='NONE';
    }
    return $image;

}

