<?php
include '/OpenServer/domains/manager/php/conect_db.php';
 $sql_tarif = '
    SELECT tariff_name
    FROM tariffs
 ';
 $result_sql_tarif = mysqli_query($link,$sql_tarif) or die(mysqli_error($link));
 for($arr_sql_tarif = []; $row = mysqli_fetch_assoc($result_sql_tarif); $arr_sql_tari[] = $row);
 $gen_tarif = '';
 foreach($arr_sql_tari as $elem){
    $gen_tarif .= '
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
};
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
    $sql_history_accurals = '
        SELECT accruals_history.accrual_history_date, tariffs.tariff_name, count_status.count_status_name,calc_unit.calc_unit_name
        FROM accruals_history
        INNER JOIN tariffs ON tariffs.id_tariff = accruals_history.id_tariff
        INNER JOIN count_status ON count_status.id_count_status = accruals_history.id_count_status
        INNER JOIN calc_unit ON calc_unit.id_calc_unit = accruals_history.id_calc_unit
        WHERE accruals_history.id_accruals = '.$_POST['id_accrual'];

    $result_sql_history = mysqli_query($link,$sql_history_accurals) or die (mysqli_error($link));
    for($arr_sql_result = []; $row = mysqli_fetch_assoc($result_sql_history); $arr_sql_result[] = $row);
    $render_history_table = '';
    foreach($arr_sql_result as $elem){
        $render_history_table .= '
            <div class="gardeneer_catd_action_grid_action">
                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['accrual_history_date'].'</span></div>
                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['tariff_name'].'</span></div>
                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['count_status_name'].'</span></div>
                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['calc_unit_name'].'</span></div>
                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                        class="gardeneer_catd_action_grid_action_itm_text">Председатель</span></div>
            </div>
        ';
    };
    $sql_servise_change = '
        SELECT services.service_name, tariffs.tariff_name, count_status.count_status_name,calc_unit.calc_unit_name
        FROM plot_accruals
        INNER JOIN tariffs ON tariffs.id_tariff =  plot_accruals.id_tariff
        INNER JOIN count_status ON count_status.id_count_status =  plot_accruals.id_counter_status
        INNER JOIN calc_unit ON calc_unit.id_calc_unit = plot_accruals.id_calc_unit
        INNER JOIN services ON services.id_service = plot_accruals.id_service
        WHERE plot_accruals.id_accruals = '.$_POST['id_accrual'];

    $result_sql_change = mysqli_query($link,$sql_servise_change) or die(mysqli_error($link));
    for($arr_changes = []; $row = mysqli_fetch_assoc($result_sql_change); $arr_changes[] = $row);
echo
'<form class="modal_change modal_redactor" id="modal_change" data-code="'.$_POST['id_accrual'].'">
    <div class="modal_name_close">
        <span class="moda_text font__25 no_target">Редактор начисления</span>
        <div class="close_x"><i class="fa fa-times close_form no_target modal_save_close" aria-hidden="true"
                id="test"></i></div>
    </div>
    <div class="modal_button">
        <div class="modal_button_left no_target">
            <div class="modal_button_item active font__14 no_target modal_save_close">Записать и закрыть</div>
            <div class="modal_button_item font__14 no_target modal_save">Записать</div>
            <div class="modal_button_item close_form font__14 modal_save_close no_target"><i class="fa fa-times no_target" aria-hidden="true"></i>Закрыть</div>
        </div>
    </div>
    <div class="modal_action_up font__14 no_target">
        <span class="modal_action_item">Услуга:</span>
        <div class="modal_action_inp no_target">
            <input type="text" class="modal_action_item get_change no_target input_pointer_none" name="service" value="'.$arr_changes[0]['service_name'].'">
        </div>
        <span class="modal_action_item">Дата записи новых значений:</span>
        <input type="date" class="no_target" name="date_create" value="'.date('Y-m-d').'">
    </div>
    <div class="modal_action no_target">
        <div class="make_service_button_table">
            <div class="make_service_main_table">
                <div class="make_service_main_button main_panel_left active_servise_button">Текущие значения</div>
                <div class="make_service_main_button right">История</div>
            </div>
            <div class="modal_action_on modal_tab" style="display:block">
                <div class="modal_action_down font__14 no_target">
                    <div class="modal_action_left no_target">
                        <div class="modal_action_item">Тариф:</div>
                        <div class="modal_action_item">Единица расчета:</div>
                        <div class="modal_action_item">Статус участия в расчетах:</div>
                    </div>
                    <div class="modal_action_right no_target">
                        <div class="modal_action_inp">
                            <input type="text" class="modal_action_item get_change no_target" name="tarif" value="'.$arr_changes[0]['tariff_name'].'">
                            <i class="fa fa-arrow-down open_arrow no_target" aria-hidden="true"></i>
                            <div class="many_point no_target">...</div>
                            <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gen_tarif.'
                            </div>
                        </div>
                        <div class="modal_action_inp no_target no_target">
                            <input type="text" class="modal_action_item get_change no_target litle_padding" name="calc_unit" value="'.$arr_changes[0]['calc_unit_name'].'">
                            <i class="fa fa-arrow-down open_arrow" aria-hidden="true" style="right:0"></i>
                            <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gener_input_calc_unit.'
                            </div>
                        </div>
                        <div class="modal_action_inp no_target">
                            <input type="text" class="modal_action_item get_change no_target litle_padding" name="count_status" value="'.$arr_changes[0]['count_status_name'].'">
                            <i class="fa fa-arrow-down open_arrow no_target" aria-hidden="true" style="right:0"></i>
                            <div class="modal_action_inp_elem no_target modal_select_list">
                            '.$gener_input_status_count.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal_action_on modal_tab">
                <div class="make_service_button">
                    <div class="make_service_button_item" data-status="search">Найти</div>
                    <button class="make_service_button_item" disabled>Отменить поиск</button>
                </div>
                <div class="make_service_date_write">
                    <div class="modal_change_table">
                        <div class="gardeneer_catd_action_grid_header">
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Период</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Вид тарифа</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Статус участья в..
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Единица расчета
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Регистратор</div>
                        </div>
                        <div class="table_elem_form">
                            '.$render_history_table.'
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>';