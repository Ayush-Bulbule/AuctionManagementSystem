<?php
session_start();
ini_set('display_errors', 1);
class Action
{
    private $db;

    public function __construct()
    {
        ob_start();
        include 'db_connect.php';

        $this->db = $conn;
    }
    function __destruct()
    {
        $this->db->close();
        ob_end_flush();
    }

    function login()
    {

        extract($_POST);
        $qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'passwors' && !is_numeric($key))
                    $_SESSION['login_' . $key] = $value;
            }
            if ($_SESSION['login_type'] != 1) {
                foreach ($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }
                return 2;
                exit;
            }
            return 1;
        } else {
            return 3;
        }
    }
    function login2()
    {

        extract($_POST);
        $qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'passwors' && !is_numeric($key))
                    $_SESSION['login_' . $key] = $value;
            }
            if ($_SESSION['login_type'] == 1) {
                foreach ($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }
                return 2;
                exit;
            }
            return 1;
        } else {
            return 3;
        }
    }
    function logout()
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }
    function logout2()
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:../index.php");
    }

    function save_user()
    {
        extract($_POST);
        $data = " name = '$name' ";
        $data .= ", username = '$username' ";
        if (!empty($password))
            $data .= ", password = '" . md5($password) . "' ";
        $data .= ", type = '$type' ";
        if ($type == 1)
            $establishment_id = 0;
        $chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
        if ($chk > 0) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users set " . $data);
        } else {
            $save = $this->db->query("UPDATE users set " . $data . " where id = " . $id);
        }
        if ($save) {
            return 1;
        }
    }
    function delete_user()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM users where id = " . $id);
        if ($delete)
            return 1;
    }
    function signup()
    {
        extract($_POST);
        $data = " name = '$name' ";
        $data .= ", username = '$username' ";
        $data .= ", email = '$email' ";
        $data .= ", contact = '$contact' ";
        $data .= ", address = '$address' ";
        $data .= ", password = '" . md5($password) . "' ";
        $chk = $this->db->query("SELECT * FROM users where username = '$username' ")->num_rows;
        if ($chk > 0) {
            return 2;
            exit;
        }
        $save = $this->db->query("INSERT INTO users set " . $data);
        if ($save) {
            $login = $this->login2();
            if ($login)
                return $login;
        }
    }
    function update_account()
    {
        extract($_POST);
        $data = " name = '" . $firstname . ' ' . $lastname . "' ";
        $data .= ", username = '$email' ";
        if (!empty($password))
            $data .= ", password = '" . md5($password) . "' ";
        $chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
        if ($chk > 0) {
            return 2;
            exit;
        }
        $save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
        if ($save) {
            $data = '';
            foreach ($_POST as $k => $v) {
                if ($k == 'password')
                    continue;
                if (empty($data) && !is_numeric($k))
                    $data = " $k = '$v' ";
                else
                    $data .= ", $k = '$v' ";
            }
            if ($_FILES['img']['tmp_name'] != '') {
                $fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
                $data .= ", avatar = '$fname' ";
            }
            $save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
            if ($data) {
                foreach ($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }
                $login = $this->login2();
                if ($login)
                    return 1;
            }
        }
    }

    function save_settings()
    {
        extract($_POST);
        $data = " name = '" . str_replace("'", "&#x2019;", $name) . "' ";
        $data .= ", email = '$email' ";
        $data .= ", contact = '$contact' ";
        $data .= ", about_content = '" . htmlentities(str_replace("'", "&#x2019;", $about)) . "' ";
        if ($_FILES['img']['tmp_name'] != '') {
            $fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
            $move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
            $data .= ", cover_img = '$fname' ";
        }

        // echo "INSERT INTO system_settings set ".$data;
        $chk = $this->db->query("SELECT * FROM system_settings");
        if ($chk->num_rows > 0) {
            $save = $this->db->query("UPDATE system_settings set " . $data);
        } else {
            $save = $this->db->query("INSERT INTO system_settings set " . $data);
        }
        if ($save) {
            $query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
            foreach ($query as $key => $value) {
                if (!is_numeric($key))
                    $_SESSION['system'][$key] = $value;
            }

            return 1;
        }
    }


    function save_category()
    {
        extract($_POST);
        $data = " name = '$name' ";
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO categories set $data");
        } else {
            $save = $this->db->query("UPDATE categories set $data where id = $id");
        }
        if ($save)
            return 1;
    }
    function delete_category()
    {
        extract($_POST);
        print_r($_POST);
        if (!empty($id)) {
            $delete = $this->db->query("DELETE FROM categories WHERE id = " . $id);
            echo $id;
            echo "id is here!";
            return 1;
        } else {
            return 0;
        }
    }
    function save_product()
    {
        print_r($_POST);
        print_r($_FILES['img']);
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'img')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }

        if (empty($id)) {
            $save = $this->db->query("INSERT INTO products set $data");
            $id = $this->db->insert_id;
        } else {
            $save = $this->db->query("UPDATE products set $data where id = $id");
        }

        if ($save) {

            if ($_FILES['img']['tmp_name'] != '') {
                $ftype = explode('.', $_FILES['img']['name']);
                $ftype = end($ftype);
                $fname = $id . '.' . $ftype;
                if (is_file('assets/uploads/' . $fname))
                    unlink('assets/uploads/' . $fname);
                $move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
                $save = $this->db->query("UPDATE products set img_fname='$fname' where id = $id");
            }
            return 1;
        }
    }
    function delete_product()
    {
        extract($_POST);
        print_r("DELETE FROM products where id = " . $id);
        $delete = $this->db->query("DELETE FROM products where id = " . $id);
        return $delete;
    }
    function get_latest_bid()
    {
        extract($_POST);
        $get = $this->db->query("SELECT * FROM bids where product_id = $product_id order by bid_amount desc limit 1 ");
        $bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0;
        return $bid;
    }
    function save_bid()
    {
        extract($_POST);
        $data = "";
        $chk = $this->db->query("SELECT * FROM bids where product_id = $product_id order by bid_amount desc limit 1 ");
        $uid = $chk->num_rows > 0 ? $chk->fetch_array()['user_id'] : 0;
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        $data .= ", user_id='{$_SESSION['login_id']}' ";

        if ($uid == $_SESSION['login_id']) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO bids set " . $data);
        } else {
            $save = $this->db->query("UPDATE bids set " . $data . " where id=" . $id);
        }
        if ($save)
            return 1;
    }
    function delete_book()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM books where id = " . $id);
        if ($delete) {
            return 1;
        }
    }
    function get_booked_details()
    {
        extract($_POST);
        $qry = $this->db->query("SELECT b.*,c.brand, c.model FROM books b inner join cars c on c.id = b.car_id where b.id = $id ")->fetch_array();
        $data = array();
        foreach ($qry as $k => $v) {
            if (!is_numeric($k))
                $data[$k] = $v;
        }
        return json_encode($data);
    }
}
