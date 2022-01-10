<?php

// 
define('SITEURL', '/PHP_Programs/ContactsBook/');
define('ADMINURL', '/PHP_Programs/AuctionSystem/admin/');
define('Category', '/PHP_Programs/AuctionSystem/admin/index.php?page=categories');
define('LOGINURL', '/PHP_Programs/ContactsBook/login.php');
define('PROFILEURL', '/PHP_Programs/ContactsBook/profile.php');
define('LOGOUTURL', '/PHP_Programs/ContactsBook/logout.php');
define('ADDCONTACT', '/PHP_Programs/ContactsBook/addContact.php');
define('VIEW', '/PHP_Programs/ContactsBook/view.php');



function print_arr($arr)
{
    echo "<pre>";
    print_r($arr);
}


//Pagination

function getPagination($total_records,  $current_page = 1, $per_page = 2)
{
    $total_pages = !empty($total_records) ? ceil($total_records / $per_page) : 1;

    if ($total_pages >= 1) {

        $prevClass = $current_page <= 1 ? "disabled" : "";
        $pagination = '<nav aria-label="Page navigation example">
        <ul class="pagination">';
        $pagination .= '
        <li class="page-item ' . $prevClass . '"><a class="page-link disabled" href="' . SITEURL . 'index.php?page=' . ($current_page - 1) . '">Previous</a></li>
        ';

        for ($i = 1; $i <= $total_pages; $i++) {
            // echo $current_page;

            if ($i == $current_page) {

                $pagination .= '
                <li class="page-item active"><a class="page-link disabled" href="' . SITEURL . 'index.php?page=' . ($current_page + 1) . '">' . $i . '</a></li>

            ';
            } else {
                $pagination .= '
                <li class="page-item"><a class="page-link disabled" href="' . SITEURL . 'index.php?page=' . $i . '">' . $i . '</a></li>
                ';
            }
        }

        $nextClass = $current_page >= $total_pages ? "disabled" : "";
        $pagination .= '<li class="page-item ' . $nextClass . '"><a class="page-link" href="' . SITEURL . 'index.php?page=' . ($current_page + 1) . '">Next</a></li>';
        $pagination .= ' </ul>
    </nav>';

        echo $pagination;
    }
}
