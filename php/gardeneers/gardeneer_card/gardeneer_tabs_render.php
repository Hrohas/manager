<?php
    function gardaner_card_render($link,$get_number,$get_name,$id_plot){
        $gener_div = '';
        switch ($get_number){
            case 0:
                $main_sql_tab = '
                SELECT plot_information.plot_square,plot_information.title_document_own,gardener_cards.email_gardener,gardener_cards.phone,gardener_cards.address 
                FROM gardener_cards INNER JOIN plot_information ON gardener_cards.id_plot = plot_information.id_plot
                WHERE gardener_cards.FIO_gardener = "'.$get_name.'"';
                $result_sql_tab = mysqli_query($link,$main_sql_tab) or die(mysqli_error($link));
                for($arr_sql_tab=[];$row = mysqli_fetch_assoc($result_sql_tab);$arr_sql_tab[]=$row);
                $gener_div = '
                    <div class="main_settigs">
                        <div class="main_settigs_item">
                            <span class="settigs font__25 all_settings">Характеристики участка</span>
                            <div class="main_settigs_items"><span class="font__14 user_select">Дата записи периодических реквизитов:</span><input type="date" class="plot_write" ></div>
                            <div class="main_settigs_items"><span class="font__14 user_select">Площадь садового участка:</span><input type="text" class="plot_sqw" value="'.$arr_sql_tab[0]['plot_square'].'"></div>
                            <div class="main_settigs_items"><span class="font__14 user_select">Документ на собственность:</span><input type="text" class="document_property" value="'.$arr_sql_tab[0]['title_document_own'].'"></div>
                            <div class="main_settigs_items"><span class="font__14 user_select">Горячая вода:</span></div>
                            <div class="main_settigs_items" style="width: 24%;"><label for="yes">Есть</label><input type="radio" id="yes" name="water"><label for="no">Нет</label><input type="radio" id="no" name="water"></div>
                            <div class="main_settigs_items"><span class="font__14 user_select">Электричество:</span></div>
                            <div class="main_settigs_items" style="width: 24%;"><label for="yes_el">Есть</label><input type="radio" id="yes_el" name="electro"><label for="no_el">Нет</label><input type="radio" id="no_el" name="electro"></div>
                            <div class="main_settigs_items"><a href="#" class="histori">История</a></div>
                        </div>
                        <div class="main_settigs_item">
                            <span class="phone_addres_item font__25 all_settings ">Персональные данные</span>
                            <span class="user_select" style="font-size: 20px;">Паспортные данные:</span>
                            <div class="phone_addres_items"><span class="font__14 user_select">Серия и номер:</span><input></div>
                            <div class="phone_addres_items"><span class="font__14 user_select">Кем выдан:</span><input></div>
                            <div class="phone_addres_items"><span class="font__14 user_select">Адрес прописки:</span><input></div>
                            <div class="phone_addres_items"><span class="font__14 user_select">Фактический адресс проживания:</span><input>'.$arr_sql_tab[0]['address'].'</input></div>
                            <span class="user_select" style="display:inline-block;font-size: 20px;margin-top:10px;">Контактные данные:</span>
                            <div class="phone_addres_items"><span class="font__14 user_select">E-mail:</span><input value="'.$arr_sql_tab[0]['email_gardener'].'"></div>
                            <div class="phone_addres_items"><span class="font__14 user_select">Телефон:</span><input value="'.$arr_sql_tab[0]['phone'].'"></div>
                            <div class="phone_addres"><span class="font__14 user_select">Адрес:</span></div>
                        </div>
                    </div>
                ';
                break;
            case 1:
                $main_sql_tab = '
                SELECT plot_accruals.id_accruals, services.service_name, tariffs.tariff_name, tariffs.price, tariffs.count_unit,calc_unit.calc_unit_name,count_status.count_status_name
                FROM plot_accruals
                INNER JOIN calc_unit ON calc_unit.id_calc_unit = plot_accruals.id_calc_unit
                INNER JOIN services ON services.id_service = plot_accruals.id_service
                INNER JOIN tariffs ON tariffs.id_tariff = plot_accruals.id_tariff
                INNER JOIN count_status ON count_status.id_count_status = plot_accruals.id_counter_status
                WHERE plot_accruals.id_plot ='.$id_plot;

                $result_sql_tab = mysqli_query($link,$main_sql_tab) or die(mysqli_error($link));
                for($arr_sql_tab=[];$row = mysqli_fetch_assoc($result_sql_tab);$arr_sql_tab[]=$row);
                $gener_div_improoved = '';
                foreach($arr_sql_tab as $elem){
                    $gener_div_improoved .= '
                        <div class="gardeneer_catd_action_grid_action" data-code="'.$elem['id_accruals'].'" data-codeall="'.$id_plot.'">
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['service_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['tariff_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['price'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['count_unit'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['calc_unit_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['count_status_name'].'</div>
                        </div/>
                       
                    ';
                }
                $gener_div ='
                <div class="gardeneer_catd_action_all">
                <div class="gardeneer_catd_action">
                    <div class="catd_action_item add_form">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="font__14 user_select">Добавить</span>
                        </div>
                        <button class="catd_action_item modal_change_button" disabled><i class="fa fa-pencil" aria-hidden="true"></i><span class="font__14 user_select">Изменить</span>
                        </button>
                        <div class="catd_action_item marker_elem">Выделить всё</div>
                        <div class="catd_action_item dont_marker_elem">Отменить выделение</div>
                        <button class="catd_action_item del_elem" disabled>Удалить</button>
                    </div>
                <div class="gardeneer_catd_action_grid">
                    <div class="gardeneer_catd_action_grid_header">
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Услуга</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Тариф</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Цена</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Единица учета</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Единица расчета</div>
                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Статус участия в расчёте</div>
                    </div>
                    <div class="table_elem_form main_accural_table">
                        '.$gener_div_improoved.'
                            </div>
                        </div>
                    </div>
                </div>
                ';
                break;
            case 2:
                $main_sql_tab = '
                    SELECT counter_list.status_counter,counter_list.id_counter,counter_list.counter_type,counter_list.counter_description,counter_list.create_date,counter_list.serial_number 
                    FROM counter_list
                    WHERE counter_list.id_plot = '.$id_plot; 

                    $result_sql_tab = mysqli_query($link,$main_sql_tab) or die(mysqli_error($link));
                    for($arr_sql_tab=[]; $row=mysqli_fetch_assoc($result_sql_tab);$arr_sql_tab[]=$row);
                    $order = 0;
                    if(!empty($_GET['order'])){
                        $order = $_GET['order'];
                    }
                    $right_sql_tabl = '
                    SELECT counter_indication_list.indication_end_date, counter_indication_list.registrator,type_indication_counts.type_name,services.service_name,counter_indication_list.indication_end
                    FROM counter_indication_list 
                    INNER JOIN type_indication_counts ON type_indication_counts.id_type = counter_indication_list.id_type
                    INNER JOIN services ON services.id_service = counter_indication_list.id_service
                    WHERE counter_indication_list.id_counter = '.$arr_sql_tab[$order]['id_counter'];
                $result_sql_right = mysqli_query($link,$right_sql_tabl) or die(mysqli_error(($link)));
                for($arr_sql_right=[];$row=mysqli_fetch_assoc($result_sql_right);$arr_sql_right[]=$row);
                $gener_div_improoved = '';
                $gener_right_table ='';
                foreach($arr_sql_tab as $elem){
                    $gener_div_first ='';
                    if($elem['status_counter'] == 'on'){
                        $gener_div_first ='<div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><i class="fa fa-check" aria-hidden="true"></i></div>';
                    }else{
                        $gener_div_first = '<div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><i class="fa fa-times" aria-hidden="true"></i></div>';
                    }
                    $gener_div_improoved .= '
                        <div class="gardeneer_catd_action_grid_action">
                            '.$gener_div_first.'
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['id_counter'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['counter_type'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['counter_description'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['create_date'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['serial_number'].'</div>
                        </div>
                    ';
                }
                foreach($arr_sql_right as $elem){
                    $gener_right_table .='
                    <div class="gardeneer_catd_action_grid_action">
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['indication_end_date'].'</div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['registrator'].'</div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['type_name'].'</div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['service_name'].'</div>
                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['indication_end'].'</div>
                    </div>
                    ';
                }
                $gener_div = '
                <div class="all_form counters">
                <div class="left_form">
                    <div class="gardeneer_catd_action_onebutton">
                        <div class="father_button">
                            <div class="button_left">
                                <div class="catd_action_item font__14 user_select create_counter">Создать
                                </div>
                                <div class="catd_action_item">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                </div>
                                <div class="catd_action_item" data-status="search">
                                    <span class="font__14 user_select">Найти..</span>
                                </div>
                                <div class="catd_action_item">
                                    <span class="font__14 user_select"><button disabled="true">Отменить поиск</button> </span>
                                </div>
                                <div class="catd_action_item indications_counters">
                                    <span class="font__14 user_select indications_counters">Внести показания</span>
                                </div>
                            </div>
                            <div class="button_rigt">
                            </div>
                        </div>
                        <div class="border_table">
                            <div class="gardeneer_catd_action_grid">
                                <div class="gardeneer_catd_action_grid_header bottom">
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Включен
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Код
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Наименование<i class="fa fa-arrow-down" aria-hidden="true"></i></div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Описание
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Дата выпуска
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Номер
                                    </div>
                                </div>
                                <div class="gardeneer_catd_action_grid_action_border table_elem_form">
                                    '.$gener_div_improoved.'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right_form">
                    <div class="gardeneer_catd_action_onebutton">
                        <div class="father_button">
                            <div class="button_left">
                                <div class="catd_action_item" data-status="search">
                                    <span class="font__14 user_select">Найти..</span>
                                </div>
                                <div class="catd_action_item">
                                    <span class="font__14 user_select"><button disabled="true">Отменить поиск</button></span>
                                </div>
                            </div>
                            <div class="button_rigt">
                                <div class="catd_action_item">
                                    <span class="font__14 user_select">Еще</span><i class="fa fa-arrow-down"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="border_table">
                            <div class="gardeneer_catd_action_grid">
                                <div class="gardeneer_catd_action_grid_header bottom">
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Период
                                        действия</div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Регистратор</div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Вид
                                        показаний</div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Вид
                                        расчета</div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">
                                        Количество</div>
                                </div>
                                <div class="gardeneer_catd_action_grid_action_border table_elem_form">
                                    '.$gener_right_table.'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                ';
                break;
            case 3:
                $main_sql_tab = '
                    SELECT services.service_name, developers.developer_name, history_settlement.initial_balance,history_settlement.accruals,history_settlement.recalculations, history_settlement.payment,history_settlement.final_balance 
                    FROM history_settlement 
                    INNER JOIN services ON services.id_service = history_settlement.id_service 
                    INNER JOIN developers ON developers.id_developer = history_settlement.id_developer 
                    WHERE history_settlement.id_plot = '.$id_plot;
                $result_sql_tab = mysqli_query($link,$main_sql_tab) or die(mysqli_error($link));
                for($arr_sql_tab=[]; $row = mysqli_fetch_assoc($result_sql_tab); $arr_sql_tab[]=$row);
                $gener_div_improoved = '';
                foreach($arr_sql_tab as $elem){
                    $gener_div_improoved .= '
                        <div class="gardeneer_catd_action_grid_action_calc count">
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['service_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['developer_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['initial_balance'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['accruals'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['recalculations'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['payment'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select">'.$elem['final_balance'].'</div>
                        </div>
                    ';
                }
                $gener_div = '
                    <div class="gardeneer_catd_action_onebutton">
                    <div class="catd_action_item">
                        <i class="fa fa-refresh" aria-hidden="true"></i></i><span
                            class="font__14 user_select">Изменить</span>
                    </div>
                </div>
                <div class="gardeneer_catd_action_grid">
                    <div class="gardeneer_catd_action_grid_border">
                        <div class="gardeneer_catd_action_grid_calc">
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Вид расчета</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Поставщик</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Начальный остаток
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Начисления</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Перерасчеты</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Оплата</div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Конечный остаток</div>
                        </div>
                        <div class="gardeneer_catd_action_grid_action_border table_elem_form">
                            '.$gener_div_improoved.'
                        </div>
                    </div>
                    <div class="gardeneer_catd_action_grid_border">
                        <div class="gardeneer_catd_action_grid_calc">
                            <div class="gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary">Итого:</span></div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary"></span></div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary"></span></div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary"></span></div>
                            <div class="calculations gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary">3</span></div>
                            <div class="calculations gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary">35</span></div>
                            <div class="calculations gardeneer_catd_action_grid_header_items font__14 father_sum"><span
                                    class="summary">343</span></div>
                        </div>
                    </div>
                </div>
                </div>
                ';
        }
        return $gener_div;
    }
    if(!empty($_GET['number'])){
        echo gardaner_card_render($link,$_GET['number'],$_GET['name'],$id_plot);
    }else{
        echo gardaner_card_render($link,0,$_GET['name'],$id_plot);
    }
?>