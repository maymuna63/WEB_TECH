<?php
    require('../inc/bd_config.php');
    require('../inc/essentials.php');
    adminLogin();
    if(isset($_POST['get_general'])){
        $q = "select * FROM 'settings' WHERE 'sl_no'=?";
        $values = [1];
        $res = select($q,$values,"i");
        $data = mysquli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['get_general']))
    {
        $frm_data = filteration($_POST);
        $q = "UPDATE 'settings' SET 'site_title'=?, 'site_about'=? WHERE 'sl_no'=?";
        $values = [$frm_data['site_title'], $frm_data['site_about'],1];
        $res = update($q,$values,'ssi');
        echo $res;
    }

?>