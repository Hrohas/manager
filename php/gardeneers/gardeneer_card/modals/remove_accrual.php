<?php
   include '/OpenServer/domains/manager/php/conect_db.php';
    if(!empty($_POST['del_elem'])){
        $sql_del = '
        DELETE FROM plot_accruals
        WHERE id_accruals = '.$_POST['del_elem'];
        $result_sql_del = mysqli_query($link,$sql_del) or die(mysqli_error($link));
    }
    if(!empty($_POST['del_elems'])){ 
        $sql_del = '
        DELETE FROM plot_accruals
        WHERE id_plot = '.$_POST['del_elems'];
        $result_sql_del = mysqli_query($link,$sql_del) or die(mysqli_error($link));
    }
        