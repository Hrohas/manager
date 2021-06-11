<?php
include '/OpenServer/domains/manager/php/conect_db.php';

$sql_counter_indication = '
    SELECT counter_indication_list.id_indication, type_indication_counts.type_name,counter_indication_list.indication_start,counter_indication_list.indication_end,counter_indication_list.indication_start_date, counter_indication_list.indication_end_date, counter_indication_list.indication_date
    FROM counter_indication_list
    INNER JOIN  type_indication_counts ON type_indication_counts.id_type = counter_indication_list.id_type
    WHERE counter_indication_list.id_counter = '.$_POST['id_counter'].'
';
$send_sql_indication = mysqli_query($link,$sql_counter_indication) or die($link);
for($counter_indication = []; $row = mysqli_fetch_assoc($send_sql_indication); $counter_indication[] = $row);
$gener_indication = '';
$sql_counter_list = '
    SELECT gardener_cards.FIO_gardener, plot_information.plot_number,counter_list.counter_type
    FROM counter_list
    INNER JOIN gardener_cards ON gardener_cards.id_gardener = counter_list.id_gardener
    INNER JOIN plot_information ON plot_information.id_plot = counter_list.id_plot
    WHERE counter_list.id_counter = '.$_POST['id_counter'].'
';
$send_sql_counter_list = mysqli_query($link,$sql_counter_list) or die($link);
for($counter_list = []; $row = mysqli_fetch_assoc($send_sql_counter_list); $counter_list[] = $row);
$action = '';
foreach($counter_indication as $elem){
    foreach($counter_list as $el){
        $action = '  <div class="gardeneer_catd_action_grid_action">
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">
        '.$_POST['id_counter'].'
        </div>
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">
            <div style="padding:5px 0;border-bottom: 2px solid #c6c6c6;">'.$el['FIO_gardener'].'
            </div>
            <div style="padding-top: 5px;">'.$el['plot_number'].'</div>
        </div>
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$el['counter_type'].'</div>
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['type_name'].'</div>
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">
            <div style="
                display: flex;justify-content: space-around;border-bottom: 2px solid #c6c6c6;">
                <div
                    style="border-right: 2px solid #c6c6c6;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;">
                    '.$elem['indication_start'].'</div>
                <div style="padding-top: 5px;padding-bottom: 5px;">'.$elem['indication_end'].'</div>
            </div>
            <div style="padding: 5px 0px;">'.$elem['indication_end'] - $elem['indication_start'].'</div>
        </div>
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">
            <div style="padding:5px 0;border-bottom: 2px solid #c6c6c6;">'.$elem['indication_start_date'].'</div>
            <div style="padding-top: 5px;">'.$elem['indication_end_date'].'</div>
        </div>
        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['indication_date'].'</div>
        </div>';
    }
}

echo'<div class="indications_counters">
    <div class="main_panel">
        <div class="main_panel_left">
            <div class="fio_type margin-right_45px">
                <span class="fio font__25">Добавление услуг и тарифов</span>
            </div>
            </div>
            <div class="close close_x">
                <i class="fa fa-times close_x" aria-hidden="true"></i>
            </div>
        </div>
        <div class="main_servises">
            <a href="index.php?gardeneers_button_number=0"
                class="main_servises_itm font__14 user_select main_active">Основное</a>
            <a href="index.php?gardeneers_button_number=1" class="main_servises_itm font__14 user_select">Показания
                счетчиков</a>
        </div>
        <div class="main_panel_left main_panel_button">
            <div class="main_action active font__14">Перевести и закрыть</div>
            <div class="main_action font__14">Записать</div>
            <div class="main_action font__14">Перевести</div>
            <div class="main_action font__14">Заполнить</div>
        </div>
        <div class="input_flex">
            <div class="modal_action_down font__14 no_target">
                <div class="modal_action_left no_target">
                    <div class="modal_action_item font__14">Номер:</div>
                </div>
                <div class="modal_action_right no_target">
                    <div class="modal_action_inp">
                        <input class="input_without_block" type="text" name="tarif" style="margin-left: 54px;">
                    </div>
                </div>
            </div>
            <div class="modal_action_down font__14 no_target" style="margin-left: 8px;">
                <div class="modal_action_left no_target">
                    <div class="modal_action_item font__14 ">От:</div>
                </div>
                <div class="modal_action_right no_target">
                    <div class="modal_action_inp">
                        <input class="input_without_block" type="date" style="width: 124%;margin-left: 6px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal_action_down down font__14 no_target">
            <div class="modal_action_left no_target">
                <div class="modal_action_item font__14">Тип операции:</div>
            </div>
            <div class="modal_action_right no_target">
                <div class="modal_action_inp">
                <input class="input_without_block" type="text" style="margin-left: 8px;"><i class="fa fa-arrow-down open_arrow no_target" aria-hidden="true" style="right: 1px;top: 3px;"></i>
                </div>
            </div>
        </div>
        <div class="parametrs">
            <span class="font__25 user_select" style="padding: 10px 0 5px 0;display: inline-block;">Параметры формирования</span>
            <div class="parametrs_form">
                <div class="main_panel_left main_panel_button">
                    <div class="main_action active font__14">Добавить</div>
                    <div class="button_arrow">
                        <div class="button_main_items arrow_one"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                        </div>
                        <div class="button_main_items arrow_two"><i class="fa fa-arrow-down" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="main_action font__14" data-status="search">Найти</div>
                    <div class="main_action font__14">Отменить поиск</div>
                </div>
                <div class="table_width">
                    <div class="gardeneer_catd_action_grid_header">
                        <div class="gardeneer_catd_action_grid_header_items user_select">Номер показания
                        </div>
                        <div class="gardeneer_catd_action_grid_header_items user_select">
                            <div style="padding:5px 0;border-bottom: 2px solid #c6c6c6;">Карточка садовода
                            </div>
                            <div style="padding-top: 5px;">Участок</div>
                        </div>
                        <div class="gardeneer_catd_action_grid_header_items user_select">Счетчики</div>
                        <div class="gardeneer_catd_action_grid_header_items user_select">Виды показаний</div>
                        <div class="gardeneer_catd_action_grid_header_items user_select">
                            <div style="
                                    display: flex;justify-content: space-around;border-bottom: 2px solid #c6c6c6;">
                                <div
                                    style="border-right: 2px solid #c6c6c6;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;">
                                    Началные показания</div>
                                <div style="padding-top: 5px;padding-bottom: 5px;">Конечные показания</div>
                            </div>
                            <div style="padding: 5px 0px;">Количество</div>
                        </div>
                        <div class="gardeneer_catd_action_grid_header_items user_select">
                            <div style="padding:5px 0;border-bottom: 2px solid #c6c6c6;">Дата начала показаний</div>
                            <div style="padding-top: 5px;">Дата окончания</div>
                        </div>
                        <div class="gardeneer_catd_action_grid_header_items user_select">Дата последних показаний</div>
                    </div>
                    <div class="elem_form">
                        '.$action.'
                    </div>
                </div>
            </div>
        </div>
        <div class="responsebl_comment">
            <div class="responsebl_comment_item"><span>Коммент</span><input type="text" style="width: 84%;"></div>
            <div class="responsebl_comment_item"><span>Ответственный</span><input type="text"></div>
        </div>';