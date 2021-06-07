<?php
include '/OpenServer/domains/manager/php/conect_db.php';
    $sql_type = '
        SELECT service_type_name
        FROM service_types
    ';
    $result_sql_type = mysqli_query($link,$sql_type) or die(mysqli_error($link));
    for($arr_sql_type = []; $row = mysqli_fetch_assoc($result_sql_type); $arr_sql_type[]=$row);
    $gen_type = '';
    foreach($arr_sql_type as $elem){
        $gen_type .= '
            <div class="elem_item modal_action_inp_item">'.$elem['service_type_name'].'</div>
        ';
    }
    $sql_fin_basis = '
        SELECT finance_basis_name
        FROM finance_basis
    ';
    $result_sql_fb = mysqli_query($link,$sql_fin_basis) or die (mysqli_error($link));
    for($arr_fb = []; $row = mysqli_fetch_assoc($result_sql_fb); $arr_fb[]=$row);
    $gen_fin_basis = '';
    foreach($arr_fb as $elem){
        $gen_fin_basis .= '
            <div class="elem_item modal_action_inp_item">'.$elem['finance_basis_name'].'</div>
        '; 
    }
    $sql_nds = '
        SELECT NDS_name
        FROM nds
    ';
    $result_sql_nds = mysqli_query($link,$sql_nds) or die(mysqli_error($link));
    for($arr_nds = [];$row = mysqli_fetch_assoc($result_sql_nds); $arr_nds[] = $row);
    $gen_nds = '';
    foreach($arr_nds as $elem){
        $gen_nds .= '
            <div class="elem_item modal_action_inp_item">'.$elem['NDS_name'].'</div>
        ';
    }
    echo
        '<form class="service_create_modal modal_redactor" id="service_create_modal">
            <div class="main_panel">
                <div class="main_panel_left">
                    <div class="fio_type margin-right_45px">
                        <span class="fio font__25 user_select">Услуга(Создание)</span>
                    </div>
                </div>
                <div class="right">
                    <div class="close_service close_x">
                        <i class="fa fa-times close_x" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="modal_button">
                <div class="modal_button_left no_target">
                    <button class="modal_button_item active font__14 no_target ">Записать и
                        закрыть</button>
                    <button form="modal_accural" type="submit"
                        class="modal_button_item font__14 no_target make_service_save_close">Записать</button>
                    <div class="modal_button_item close_form font__14 no_target"><i
                            class="fa fa-times no_target close_form" aria-hidden="true"></i>Закрыть</div>
                </div>
            </div>
            <div class="make_service_confing">
                <div class="make_service_confing_name">
                    <span class="make_service_confing_name_item font__14  no_target">Код:</span>
                    <span class="make_service_confing_name_item font__14  no_target">Наименование:</span>
                    <span class="make_service_confing_name_item font__14  no_target">Тип:</span>
                    <span class="make_service_confing_name_item font__14  no_target">Основание финансирования:</span>
                    <span class="make_service_confing_name_item font__14  no_target">%НДС:</span>
                </div>
                <div class="make_service_confing_inp">
                    <div class="make_service_confing_inp_item  font__14 no_target"><input class="get_id">
                    </div>
                    <div class="make_service_confing_inp_item font__14 no_target"><input>
                    </div>
                    <div class="make_service_confing_inp_item  font__14 no_target"><input class="input_padding modal_action_item">
                        <i class="fa fa-arrow-down open_arrow" aria-hidden="true"></i>
                        <div class="make_service_confing_elem modal_select_list">
                            '.$gen_type.'
                        </div>
                    </div>
                    <div class="make_service_confing_inp_item  font__14 no_target">
                        <input class="input_padding modal_action_item">
                        <i class="fa fa-arrow-down open_arrow" aria-hidden="true"></i>
                        <div class="make_service_confing_elem modal_select_list">
                            '.$gen_fin_basis.'
                        </div>
                    </div>
                    <div class="make_service_confing_inp_item  font__14 no_target">
                        <input class="input_padding modal_action_item">
                        <i class="fa fa-arrow-down open_arrow" aria-hidden="true"></i>
                        <div class="make_service_confing_elem modal_select_list">
                            '.$gen_nds.'
                        </div>
                    </div>
                </div>
            </div>
            <div class="make_service_table">
                <span class="settigs font__25 all_settings">Характеристики</span>
                <div class="make_service_button_table ">
                <div class="make_service_main_table ">
                    <div class="make_service_main_button main_panel_left active_servise_button">Дополнительные характеристики</div>
                    <div class="make_service_main_button right">История зачисления дополнительных характеристик</div>
                </div>
                <div class="make_service_date_write make_service_character modal_tab">
                    <span class="date_write_text">Дата записи переодичиских реквизитов:</span>
                    <input type="date">
                </div>
                <div class="make_service_date_write modal_tab" style="display:none;">
                    <div class="gardeneer_catd_action_grid_header">
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Период</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Регистратор</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Свойства</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Значения</div>
                    </div>
                    <div class="table_elem_form">
                    <div class="gardeneer_catd_action_grid_action">
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                class="gardeneer_catd_action_grid_action_itm_text"></span></div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                class="gardeneer_catd_action_grid_action_itm_text"></span></div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                class="gardeneer_catd_action_grid_action_itm_text"></span></div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                class="gardeneer_catd_action_grid_action_itm_text"></span></div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </form>';