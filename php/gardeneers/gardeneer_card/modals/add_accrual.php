<?php
    include '/OpenServer/domains/manager/php/conect_db.php';
var_dump($_POST);
    if(!empty($_POST['service']) && !empty($_POST['tarif']) && !empty($_POST['calc_unit']) && !empty($_POST['count_status']) && !empty($_POST['date_create'])){
        if(!empty($_POST['FIO'])) {
            $sql_gardeneer ='
            SELECT id_plot
            FROM gardener_cards
            WHERE FIO_gardener = "'.$_POST['FIO'].'"        
            ';
            $result_id_plot = mysqli_query($link,$sql_gardeneer) or die(mysqli_error($link));
            for($arr_gard_id_plot = []; $row = mysqli_fetch_assoc($result_id_plot); $arr_gard_id_plot[] = $row);
        }
        $sql_service ='
        SELECT id_service
        FROM services
        WHERE service_name = "'.$_POST['service'].'"
        ';
        $result_id_service = mysqli_query($link,$sql_service) or die(mysqli_error($link));
        for($arr_service = []; $row = mysqli_fetch_assoc($result_id_service); $arr_service[] = $row);
        $sql_tarif ='
        SELECT id_tariff
        FROM tariffs
        WHERE tariff_name = "'.$_POST['tarif'].'"
        ';
        $result_id_tariff = mysqli_query($link,$sql_tarif) or die(mysqli_error($link));
        for($arr_tariff = []; $row = mysqli_fetch_assoc($result_id_tariff); $arr_tariff[] = $row);
        $sql_status_count ='
        SELECT id_count_status
        FROM count_status
        WHERE count_status_name = "'.$_POST['count_status'].'"
        ';
        $result_id_count_status = mysqli_query($link,$sql_status_count) or die(mysqli_error($link));
        for($arr_count_status = []; $row = mysqli_fetch_assoc($result_id_count_status); $arr_count_status[] = $row);
        $sql_calc_unit ='
        SELECT id_calc_unit
        FROM calc_unit
        WHERE calc_unit_name = "'.$_POST['calc_unit'].'"
        ';
        $result_id_calc_unit = mysqli_query($link,$sql_calc_unit) or die(mysqli_error($link));
        for($arr_calc_unit = []; $row = mysqli_fetch_assoc($result_id_calc_unit); $arr_calc_unit[] = $row);
        $insert_accural = '';
        if($_POST['code'] == '0'){
            $insert_accural = ' 
            INSERT INTO plot_accruals (id_plot, id_service, id_tariff, id_counter_status, id_calc_unit)
            VALUES ('.$arr_gard_id_plot[0]['id_plot'].','.$arr_service[0]['id_service'].','.$arr_tariff[0]['id_tariff'].','.$arr_count_status[0]['id_count_status'].','.$arr_calc_unit[0]['id_calc_unit'].')
            ';
        }
        if($_POST['code'] != '0') {
            $insert_accural = '
            UPDATE plot_accruals
            SET id_service = '.$arr_service[0]['id_service'].',
            id_tariff = '.$arr_tariff[0]['id_tariff'].',
            id_counter_status = '.$arr_count_status[0]['id_count_status'].',
            id_calc_unit = '.$arr_calc_unit[0]['id_calc_unit'].'
            WHERE id_accruals ='.$_POST['code'];             
        }
        
        $send_insert = mysqli_query($link,$insert_accural) or die(mysqli_error($link));
    }
     /*   $last_insert_sql = '
            SELECT id_accruals 
            FROM  plot_accruals 
            WHERE id_accruals = LAST_INSERT_ID()
        ';
        $result_last_insert_sql = mysqli_query($link,$last_insert_sql) or die(mysqli_error($link));
        for($arr_last_inserts = []; $row = mysqli_fetch_assoc($result_last_insert_sql); $arr_last_inserts[] = $row);
        $date_write = explode('-',$_POST['date_create']);
        $post_date = implode('',$date_write);
        $insert_history_accurals = '
            INSERT INTO accruals_history (accrual_history_date,id_accruals,id_tariff,id_count_status,id_calc_unit)
            VALUES ('.$post_date.','.$arr_last_inserts[0]['id_accruals'].','.$arr_tariff[0]['id_tariff'].','.$arr_count_status[0]['id_count_status'].','.$arr_calc_unit[0]['id_calc_unit'].')
        ';
        $go_to_server = mysqli_query($link,$insert_history_accurals) or die(mysqli_error($link));*/
    