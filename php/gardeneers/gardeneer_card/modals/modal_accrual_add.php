<?php
include '/OpenServer/domains/manager/php/conect_db.php';
    $sql_service = '
        SELECT service_name 
        FROM services
    ';
    $result_sql_service = mysqli_query($link,$sql_service) or die(mysqli_error($link));
    for($arr_service = [];$row = mysqli_fetch_assoc($result_sql_service); $arr_service[] = $row);
    $gener_input_service = '';
    foreach($arr_service as $elem){
        $gener_input_service .= '
            <div class="modal_action_inp_item font__11 no_target">'.$elem['service_name'].'</div>
        ';
    }
    $sql_tarif = '
        SELECT tariff_name
        FROM tariffs
    ';
    $result_sql_tarif = mysqli_query($link,$sql_tarif) or die(mysqli_error($link));
    for($arr_tarif = [];$row = mysqli_fetch_assoc($result_sql_tarif); $arr_tarif[] = $row);
    $gener_input_tarif = '';
    foreach($arr_tarif as $elem){
        $gener_input_tarif .= '
            <div class="modal_action_inp_item font__11 no_target">'.$elem['tariff_name'].'</div>
        ';
    }
    $sql_calc_unit ='
        SELECT calc_unit_name
        FROM calc_unit
    ';
    $result_sql_calc_unit = mysqli_query($link,$sql_calc_unit) or die(mysqli_error($link));
    for($arr_sql_calc_unit = []; $row = mysqli_fetch_assoc($result_sql_calc_unit); $arr_sql_calc_unit[] = $row);
    $gener_input_calc_unit = '';
    foreach($arr_sql_calc_unit as $elem){
        $gener_input_calc_unit .= '
            <div class="modal_action_inp_item no_target font__11 no_target">'.$elem['calc_unit_name'].'</div>
        ';
    }
    $sqli_status_count = '
        SELECT count_status_name
        FROM count_status
    ';
    $result_status_count = mysqli_query($link,$sqli_status_count) or die(mysqli_error($link));
    for($arr_status_count = []; $row = mysqli_fetch_assoc($result_status_count); $arr_status_count[] = $row);
    $gener_input_status_count = '';
    foreach($arr_status_count as $elem){
        $gener_input_status_count .= '
            <div class="modal_action_inp_item font__11 no_target">'.$elem['count_status_name'].'</div>
        ';
    } 
   echo
    '
           <form class="modal_redactor_close modal_redactor" id="modal_accural" data-code="0">
           <input type="hidden" name="FIO" value="'.$_POST['FIO'].'">
            <div class="modal_name_close">
                <span class="moda_text font__25 no_target">Редактор начисления</span>
                <div class="close_x"><i class="fa fa-times close_form no_target modal_save_close" aria-hidden="true" id="test"></i></div>
            </div>
            <div class="modal_button">
                <div class="modal_button_left no_target">
                    <div class="modal_button_item active font__14 no_target modal_save_close">Записать и закрыть</div>
                    <div  class="modal_button_item font__14 no_target modal_save" data-attr="add">Записать</div>
                    <div class="modal_button_item close_form font__14 modal_save_close no_target"><i class="fa fa-times no_target" aria-hidden="true"></i>Закрыть</div>
                </div>
            </div>
            <div class="modal_action no_target">
                <div class="modal_action_up font__14 no_target">
                    <span class="modal_action_item">Услуга:</span>
                    <div class="modal_action_inp no_target">
                        <input type="text" class="modal_action_item mego_padding no_target" name="service">
                        <i class="fa fa-arrow-down open_arrow" aria-hidden="true"></i>
                        <div class="many_point no_target no_target" data-select="services">...</div>
                        <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gener_input_service.'
                        </div>
                    </div>
                    <span class="modal_action_item">Дата записи новых значений:</span>
                    <input type="date" class="no_target" name="date_create" value="'.date('Y-m-d').'">
                </div>
            </div>
            <div class="modal_action_down font__14 no_target">
                <div class="modal_action_left no_target">
                    <div class="modal_action_item">Тариф:</div>
                    <div class="modal_action_item">Единица расчета:</div>
                    <div class="modal_action_item">Статус участия в расчетах:</div>
                </div>
                <div class="modal_action_right no_target">
                    <div class="modal_action_inp">
                        <input type="text" class="modal_action_item no_target" name = "tarif">
                        <i class="fa fa-arrow-down open_arrow no_target" aria-hidden="true"></i>
                        <div class="many_point no_target" data-select="tariff">...</div>
                        <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gener_input_tarif.'
                        </div>
                    </div>
                    <div class="modal_action_inp no_target no_target">
                        <input type="text" class="modal_action_item no_target litle_padding" name="calc_unit">
                        <i class="fa fa-arrow-down open_arrow" aria-hidden="true" style="right:0"></i>
                        <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gener_input_calc_unit.'
                        </div>
                    </div>
                    <div class="modal_action_inp no_target">
                        <input type="text" class="modal_action_item no_target litle_padding" name="count_status">
                        <i class="fa fa-arrow-down open_arrow no_target" aria-hidden="true" style="right:0"></i>
                        <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gener_input_status_count.'
                        </div>
                    </div>
                </div>
            </div>
        </form>
       ';
    ?>
