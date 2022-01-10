<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if ($action == 'login') {
    $login = $crud->login();
    if ($login)
        echo $login;
}
if ($action == 'login2') {
    $login = $crud->login2();
    if ($login)
        echo $login;
}
if ($action == 'logout') {
    $logout = $crud->logout();
    if ($logout)
        echo $logout;
}
if ($action == 'logout2') {
    $logout = $crud->logout2();
    if ($logout)
        echo $logout;
}
if ($action == 'save_user') {
    $save = $crud->save_user();
    if ($save)
        echo $save;
    header("Location: ../admin/index.php?page=users");
}
if ($action == 'delete_user') {
    $save = $crud->delete_user();
    if ($save)
        echo $save;
    header("Location: ../admin/index.php?page=users");
}
if ($action == 'signup') {
    $save = $crud->signup();
    if ($save)
        echo $save;
}
if ($action == 'update_account') {
    $save = $crud->update_account();
    if ($save)
        echo $save;
}
if ($action == "save_settings") {
    $save = $crud->save_settings();
    if ($save)
        echo $save;
}

if ($action == "save_category") {
    $save = $crud->save_category();
    if ($save)
        echo $save;
    header("Location: ../admin/index.php?page=categories");
}

if ($action == "delete_category") {
    $delete = $crud->delete_category();
    if ($delete) {
        echo 'Deleted';
        echo $delete;
        header("Location: ../admin/index.php?page=categories");
    }
}

if ($action == "save_product") {
    $save = $crud->save_product();
    if ($save)
        echo $save;
    header("Location: ../admin/index.php?page=products");
}
if ($action == "delete_product") {
    $save = $crud->delete_product();
    if ($save)
        echo $save;
    header("Location: ../admin/index.php?page=products");
}
if ($action == "get_latest_bid") {
    $save = $crud->get_latest_bid();
    if ($save)
        echo $save;
}
if ($action == "save_bid") {
    extract($_POST);
    $save = $crud->save_bid();
    if ($save == 1) {
        $_SESSION['success'] = "Bid Successfully Placed!";
        header("Location: ../product_details.php?product_id=" . $id);
    } else if ($save == 2) {
        $_SESSION['errors'] = "Already Bidded !!";
        header("Location: ../product_details.php?product_id=" . $id);
    } else {
        $_SESSION['errors'] = "Bid Failed!";
        header("Location: ../product_details.php?product_id=" . $id);
    }
    if ($save)
        echo $save;
}
if ($action == "delete_book") {
    $save = $crud->delete_book();
    if ($save)
        echo $save;
}

if ($action == "get_booked_details") {
    $save = $crud->get_booked_details();
    if ($save)
        echo $save;
}

ob_end_flush();
