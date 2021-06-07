<?php
    function count_tables_render($link,$get_number){
        $gener_div = '';
        switch ($get_number){
            case 0:
                $select_gardeneer_card= '
                    SELECT gardener_cards.FIO_gardener, gardener_cards.id_gardener 
                    FROM gardener_cards
                ';
                $result_select_gardeneer_card = mysqli_query($link,$select_gardeneer_card) or die(mysqli_error($link));
                for($arr_gardeneer_card=[]; $row = mysqli_fetch_assoc($result_select_gardeneer_card); $arr_gardeneer_card[]=$row);
                $gener_div_gardeneer_card = '';
                foreach($arr_gardeneer_card as $index => $elem){
                    $inp_hid = '<input type="hidden" value="'.$elem['id_gardener'].'">';
                    if($index == 0){
                        $gener_div_gardeneer_card .= '
                        <div class="gardeneer_catd_action_grid_action select_item_active">
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><i class="fa fa-minus" aria-hidden="true"></i><span class="gardeneer_catd_action_grid_action_itm_text">'.$elem['FIO_gardener'].'</span></div>
                            '.$inp_hid.'
                        </div>'
                    ;
                    }else{
                        $gener_div_gardeneer_card .= '
                            <div class="gardeneer_catd_action_grid_action">
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><i class="fa fa-minus" aria-hidden="true"></i><span class="gardeneer_catd_action_grid_action_itm_text">'.$elem['FIO_gardener'].'</span></div>
                                 '.$inp_hid.'
                            </div>
                        ';
                    }
                }
                $id_gardeneer = 1;
                if(!empty($_GET['id_gardeneer'])){
                    $id_gardeneer = $_GET['id_gardeneer'];
                }
                $select_count = '
                    SELECT counter_list.status_counter, counter_list.counter_type, counter_list.id_counter 
                    FROM counter_list 
                    WHERE counter_list.id_gardener ='.$id_gardeneer
                ;
                $result_select_counter = mysqli_query($link,$select_count) or die(mysqli_error($link));
                for($arr_counts=[];$row = mysqli_fetch_assoc($result_select_counter);$arr_counts[]=$row);
                 $gener_div_count ='';

                foreach($arr_counts as $index => $elem){
                    if($elem['status_counter'] == 'on'){
                        $gener_div_count_status = '
                            <div class="gardeneer_catd_action_grid_header_items  user_select"><i class="fa fa-check" aria-hidden="true" style="color:green"></i></div>
                        ';
                    }else{
                        $gener_div_count_status = '
                            <div class="gardeneer_catd_action_grid_header_items  user_select"><i class="fa fa-times" aria-hidden="true" style="color:red"></i></div>
                        ';
                    }
                    if($index == 0){
                        $gener_div_count .= '
                        <div class="gardeneer_catd_action_grid_action select_item_active">
                            '.$gener_div_count_status.'
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['counter_type'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['id_counter'].'</div>
                        </div>
                    ';
                    }else{
                        $gener_div_count .= '
                            <div class="gardeneer_catd_action_grid_action">
                                '.$gener_div_count_status.'
                                <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['counter_type'].'</div>
                                <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['id_counter'].'</div>
                            </div>
                        ';
                    }
                }
                $id_counter = $arr_counts[0]['id_counter'];
                if(!empty($_GET['id_counter'])){
                    $id_counter = $_GET['id_counter'];
                }
                $history = '
                SELECT counter_indication_list.indication_date, type_indication_counts.type_name, services.service_name, counter_indication_list.indication_start, counter_indication_list.indication_end
                FROM counter_indication_list
                INNER JOIN services ON services.id_service = counter_indication_list.id_service
                INNER JOIN type_indication_counts ON type_indication_counts.id_type = counter_indication_list.id_type
                WHERE counter_indication_list.id_counter ='.$id_counter
                ;
                $result_select_history = mysqli_query($link,$history) or die(mysqli_error($link));
                for($arr_historys = []; $row = mysqli_fetch_assoc($result_select_history); $arr_historys[] = $row);
                $gener_div_history = '';
                foreach($arr_historys as $index => $elem){
                    $result = $elem['indication_end'] - $elem['indication_start'];
                    if($index == 0){
                        $gener_div_history .= '
                        <div class="gardeneer_catd_action_grid_action select_item_active">
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['indication_date'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['type_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['service_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$result.'</div>
                        </div>        
                    ';
                    }else{
                        $gener_div_history .= '
                        <div class="gardeneer_catd_action_grid_action">
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['indication_date'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['type_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem['service_name'].'</div>
                            <div class="gardeneer_catd_action_grid_action_itm  user_select">'.$result.'</div>
                        </div>        
                    ';
                    }
                    
                }
                $gener_div = '<div class="forms">
                <div class="forms_up">
                    <div class="forms_gardeenier_cart">
                        <span class="forms_gardeenier_cart_text font__14">Карточки садоводов</span>
                        <form class="button_main">
                            <div class="seartch"><input type="user_select" name="">
                                <div class="user_select"><i class="fa fa-times" aria-hidden="true"></i></div>
                            </div>
                            <div class="button_main_items user_select font__14"><i class="fa fa-search"
                                    aria-hidden="true"></i></div>
                            <div class="button_main_items user_select font__14">Ещё</div>
                        </form>
                        <div class="gardeneer_catd_action_grid_header">
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Карточка садовода
                            </div>
                        </div>
                        '.$gener_div_gardeneer_card.'
                    </div>
                    <div class="forms_counts">
                        <span class="forms_gardeenier_cart_text font__14">Счетчики</span>
                        <form class="button_main">
                            <div class="button_main_left">
                                <div class="button_main_items user_select font__14 ">Создать</div>
                                <div class="button_main_items user_select"><i class="fa fa-file-o" aria-hidden="true"></i>
                                </div>
                                <div class="button_main_items user_select">Внести показания</div>
                            </div>
                            <div class="button_main_rigt">
                                <div class="seartch"><input type="user_select" name="">
                                    <div class="user_select"><i class="fa fa-times" aria-hidden="true"></i></div>
                                </div>
                                <div class="button_main_items user_select font__14"><i class="fa fa-search"
                                        aria-hidden="true"></i></div>
                                <div class="button_main_items user_select font__14">Ещё</div>
                            </div>
                        </form>
                        <div class="gardeneer_catd_action_grid_header">
                            <div class="gardeneer_catd_action_grid_header_items  user_select"></div>
                            <div class="gardeneer_catd_action_grid_header_items  user_select">Наименование</div>
                            <div class="gardeneer_catd_action_grid_header_items  user_select">Код</div>
                        </div>
                        '.$gener_div_count.'
                    </div>
                    </div>
                    <div class="forms_down">
                    <div class="forms_history_count">
                        <span class="forms_gardeenier_cart_text font__14">История показаний</span>
            
                        <form class="button_main">
                            <div class="seartch"><input type="user_select" name="">
                                <div class="user_select"><i class="fa fa-times" aria-hidden="true"></i></div>
                            </div>
                            <div class="button_main_items user_select font__14"><i class="fa fa-search"
                                    aria-hidden="true"></i>
                            </div>
                            <div class="button_main_items user_select font__14">Ещё</div>
                        </form>
                    </div>
                    <div class="gardeneer_catd_action_grid_header">
                        <div class="gardeneer_catd_action_grid_header_items  user_select">Период</div>
                        <div class="gardeneer_catd_action_grid_header_items  user_select">Вид показаний</div>
                        <div class="gardeneer_catd_action_grid_header_items  user_select">Вид рачета</div>
                        <div class="gardeneer_catd_action_grid_header_items  user_select">Количество</div>
                    </div>
                    '.$gener_div_history.'
                    <div class="history_type font__14"><span>Обычный:0005</span></div>
                </div>
            </div>
            
            ';
            break;
            case 1:
                $select_count_indication = '
                SELECT counter_indication_list.indication_date, counter_indication_list.id_counter, counter_operation_type.operation_type_name, responsibles.responsible_name, counter_indication_list.comments
                FROM counter_indication_list
                INNER JOIN counter_operation_type ON counter_operation_type.id_counter_operation = counter_indication_list.id_counter_operation
                INNER JOIN responsibles ON responsibles.id_responsible = counter_indication_list.id_responsible
                ';
                $resalt_connect_select = mysqli_query($link,$select_count_indication) or die(mysqli_error($link));
                for($arr_count_indications = []; $row = (mysqli_fetch_assoc($resalt_connect_select)); $arr_count_indications[] = $row);
                $ganer_div_indication = '';
                foreach($arr_count_indications as $elem){
                    if(empty($elem['responsible_name'])){
                        $responsible_name = '< не указан >';
                    }else{
                        $responsible_name = $elem['responsible_name'];
                    }
                    $ganer_div_indication .= '
                        <div class="gardeneer_catd_action_grid_action">
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                    class="gardeneer_catd_action_grid_action_itm_text">'.$elem['indication_date'].'</span></div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                    class="gardeneer_catd_action_grid_action_itm_text">'.$elem['id_counter'].'</span></div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                    class="gardeneer_catd_action_grid_action_itm_text">'.$elem['operation_type_name'].'</span></div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                    class="gardeneer_catd_action_grid_action_itm_text">
                                    '.$responsible_name.'
                                </span></div>
                            <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                    class="gardeneer_catd_action_grid_action_itm_text"></span>'.$elem['comments'].'</div>

                        </div>
                    ';
                    $gener_div = '
                    <div class="forms_indication">
                    <span class="forms_gardeenier_cart_text font__25">Показание счетчиков</span>
                    <form class="button_main">
                        <div class="button_main_left">
                            <div class="button_main_items user_select font__14">Создать</div>
                            <div class="button_main_items user_select font__14"><i class="fa fa-file-o"
                                    aria-hidden="true"></i>
                            </div>
                            <div class="button_main_items user_select font__14">Найти</div>
                            <button class="button_main_items user_select font__14" disabled="true">Отменить поиск</button>
                            <div class="button_main_items user_select font__14">Распределить показания по документам</div>
                        </div>
                        <div class="button_main_rigt">
                            <div class="button_main_items user_select font__14">Ещё</div>
                            <div class="button_main_items user_select font__14">?</div>
                        </div>
                    </form>
                    <div class="forms_up">
                        <div div class="gardeneer_catd_action_grid_header">
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Дата
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Номер
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Тип операции
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Ответсвтенный
                            </div>
                            <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Комментарий
                            </div>
                        </div>
                            '.$ganer_div_indication.'
                    </div>
            </div>
                    ';
                }
                break;
                case 2:
                    $select_indication_grup = '
                    SELECT counter_indication_list_group.indication_date, counter_indication_list_group.id_counter, responsibles.responsible_name, counter_indication_list_group.comments
                    FROM counter_indication_list_group
                    INNER JOIN responsibles ON responsibles.id_responsible = counter_indication_list_group.id_responsible
                    ';
                    $result_connect_select = mysqli_query($link,$select_indication_grup) or die($link);
                    for($arr_count_indications_grup = []; $row = mysqli_fetch_assoc($result_connect_select); $arr_count_indications_grup[] = $row);
                    $ganer_div_indication_grup = '';
                    foreach($arr_count_indications_grup as $elem){
                        if(empty($elem['responsible_name'])){
                            $responsible_name = '< не указан >';
                        }else{
                            $responsible_name = $elem['responsible_name'];
                        }
                        $ganer_div_indication_grup .= '
                            <div class="gardeneer_catd_action_grid_action">
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['indication_date'].'</span></div>
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['id_counter'].'</span></div>
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                        class="gardeneer_catd_action_grid_action_itm_text">
                                        '.$responsible_name.'
                                    </span></div>
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                        class="gardeneer_catd_action_grid_action_itm_text"></span>'.$elem['comments'].'</div>
    
                            </div>
                        ';}
                        $gener_div = '
                        <div class="forms_indication_grupp">
                        <span class="forms_gardeenier_cart_text font__25">Показание групповых счетчиков</span>
                        <form class="button_main">
                            <div class="button_main_left">
                                <div class="button_main_items user_select font__14">Создать</div>
                                <button class="button_main_items user_select font__14" disabled="true"><i class="fa fa-file-o"
                                        aria-hidden="true"></i></button>
                                <div class="button_main_items user_select font__14">Найти</div>
                                <button class="button_main_items user_select font__14" disabled="true">Отменить поиск</button>
                                <div class="button_main_items user_select font__14">Создать на основание</div>
                            </div>
                            <div class="button_main_rigt">
                                <div class="button_main_items user_select font__14">Ещё</div>
                                <div class="button_main_items user_select font__14">?</div>
                            </div>
                        </form>
                        <div class="forms_up">
                            <div div class="gardeneer_catd_action_grid_header">
                                <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Дата
                                </div>
                                <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Номер
                                </div>
                                <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Ответсвтенный
                                </div>
                                <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Комментарий
                                </div>
                            </div>
                           '.$ganer_div_indication_grup.'
                        </div>
                    </div>
                        ';
                    break;
                    case 3:
                        $select_count_withput_document = '
                        SELECT counter_indication_list.indication_date, counter_indication_list.id_counter, responsibles.responsible_name, counter_indication_list.comments, counter_indication_list.indication_start_date, counter_indication_list.indication_end_date, counter_operation_type.operation_type_name
                        FROM counter_indication_list
                        INNER JOIN responsibles ON responsibles.id_responsible = counter_indication_list.id_responsible
                        INNER JOIN counter_operation_type ON counter_operation_type.id_counter_operation = counter_indication_list.id_counter_operation
                        ';
                        $resalt_connect_select = mysqli_query($link, $select_count_withput_document) or die(mysqli_error($link));
                        for($arr_without_document = []; $row = mysqli_fetch_assoc($resalt_connect_select); $arr_without_document[] = $row);
                        $gener_div_count_without = '';
                        foreach($arr_without_document as $elem){
                            $data_today = explode('-',$elem['indication_date']);
                            $data_start = explode('-',$elem['indication_start_date']);
                            $data_end = explode('-',$elem['indication_end_date']);
                            $mk_today = mktime(0,0,0, (int)$data_today[1],(int)$data_today[2],$data_today[0]);
                            $mk_start = mktime(0,0,0, (int)$data_start[1],(int)$data_start[2],(int)$data_start[0]);
                            $mk_end = mktime(0,0,0, (int)$data_end[1],(int)$data_end[2],(int)$data_end[0]);
                            $gener_div_count_without = '';
                            if($mk_today > $mk_start && $mk_today < $mk_end){
                                $mk_date = '
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><i class="fa fa-times" aria-hidden="true" style="color:red"></i></div>  
                                ';
                            }else{
                                $mk_date = '
                                <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><i class="fa fa-check" aria-hidden="true" style="color:green"></i></div>  
                                ';
                            }
                            $gener_div_count_without .= '
                                <div class="gardeneer_catd_action_grid_action">
                                    <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">'.$elem['indication_date'].'</span></div>
                                    <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">'.$elem['id_counter'].'</span></div>
                                    <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">'.$elem['comments'].'</span></div>
                                   '.$mk_date.'
                                    <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">'.$elem['responsible_name'].'</span></div>
                                    <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">'.$elem['operation_type_name'].'</span></div>
                                </div>
                            ';}
                            $gener_div = '
                            <div class="forms_without_documents">
                            <span class="forms_gardeenier_cart_text font__25">Начисления при непредоставлении показаний счетчиков</span>
                            <form class="button_main">
                                <div class="button_main_left">
                                    <div class="button_main_items user_select font__14">Создать</div>
                                    <div class="button_main_items user_select font__14"><i class="fa fa-file-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="button_main_rigt">
                                    <div class="seartch"><input type="user_select" name="">
                                        <div class="user_select" style=""><i class="fa fa-times" aria-hidden="true"></i></div>
                                    </div>
                                    <div class="button_main_items user_select font__14"><i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                    <div class="button_main_items user_select font__14">Ещё</div>
                                </div>
                            </form>
                            <div class="forms_up">
                                <div div class="gardeneer_catd_action_grid_header">
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Дата
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Номер
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Комментарий</div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Учесть предыдущие
                                        расчетные периоды
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Ответсвтенный
                                    </div>
                                    <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Тип операции
                                    </div>
                
                                </div>
                                '.$gener_div_count_without.'
                            </div>
                        </div>
                            ';                       
                        
                        break;
                        case 4:
                            $select_count_change = '
                            SELECT change_counter.date_make_change, change_counter.id_change_counter, responsibles.responsible_name, change_counter.change_comment 
                            FROM change_counter 
                            INNER JOIN responsibles ON responsibles.id_responsible = change_counter.id_responsible
                            ';
                            $result_connect_change = mysqli_query($link,$select_count_change) or die(mysqli_error($link));
                            for($arr_count_change=[]; $row = mysqli_fetch_assoc($result_connect_change); $arr_count_change[] = $row);
                            $gener_div_change = '';
                            foreach($arr_count_change as $elem){
                                if(!empty($elem['responsible_name'])){
                                    $resp_name = '
                                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">
                                            '.$elem['responsible_name'].'
                                        </span></div>
                                        ';
                                }else{
                                    $resp_name = '
                                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                            class="gardeneer_catd_action_grid_action_itm_text">
                                            < не указан>
                                        </span></div>
                                        ';
                                }
                                $gener_div_change .= '
                                    <div class="gardeneer_catd_action_grid_action">
                                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                                class="gardeneer_catd_action_grid_action_itm_text">'.$elem['date_make_change'].'</span></div>
                                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                                class="gardeneer_catd_action_grid_action_itm_text">'.$elem['id_change_counter'].'</span></div>
                                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                                class="gardeneer_catd_action_grid_action_itm_text">
                                                '.$resp_name.'
                                            </span></div>
                                        <div class="gardeneer_catd_action_grid_action_itm font__14 user_select"><span
                                        class="gardeneer_catd_action_grid_action_itm_text">'.$elem['change_comment'].'</span></div>
        
                                    </div>
                                ';}
                                $gener_div = '
                                <div class="forms_change_state">
                                <span class="forms_gardeenier_cart_text font__25">Изменение состояния счетчиков</span>
                                <form class="button_main">
                                    <div class="button_main_left">
                                        <div class="button_main_items user_select font__14">Создать</div>
                                        <div class="button_main_items user_select font__14"><i class="fa fa-file-o"
                                                aria-hidden="true"></i>
                                        </div>
                                        <div class="button_main_items user_select font__14">Найти</div>
                                        <button class="button_main_items user_select font__14" disabled="true">Отменить поиск</button>
                                    </div>
                                    <div class="button_main_rigt">
                                        <div class="button_main_items user_select font__14">Ещё</div>
                                        <div class="button_main_items user_select font__14">?</div>
                                    </div>
                                </form>
                                <div class="forms_up">
                                    <div div class="gardeneer_catd_action_grid_header">
                                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Дата
                                        </div>
                                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Номер
                                        </div>
                                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Ответсвтенный
                                        </div>
                                        <div class="gardeneer_catd_action_grid_header_items font__14 user_select">Комментарий
                                        </div>
                                    </div>
                                    '.$gener_div_change.'
                                </div>
                        
                                ';
                            break;
                        }
        return $gener_div;
    }
    if(!empty($_GET['count_button_number'])){
        echo count_tables_render($link,(int)$_GET['count_button_number']);
    }
    else{
        echo count_tables_render($link,0);
    }
?>