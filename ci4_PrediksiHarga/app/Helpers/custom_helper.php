<?php
function userLogin() {
    $db = \Config\Database::connect();
    return $db->table('users')->where('user_id', session('user_id'))->get()->getRow();
}
?>