   <?php
   include '/OpenServer/domains/manager/php/conect_db.php';
    class Window_support{
        private function get_table_content($link,$sql,$fields,$names){
            $head = '';
            foreach($names as $element){
                $head .= '<div class="gardeneer_catd_action_grid_header_items  user_select">'.$element.'</div> ';
            }
            $result_sql = mysqli_query($link,$sql) or die(mysqli_error($link));
            for($arr_result_sql = []; $row = mysqli_fetch_assoc($result_sql); $arr_result_sql[]=$row);
            $gener_div = '';
            foreach($arr_result_sql as $elem){
                $gener_str = '';
                foreach($fields as $el){
                  $gener_str .='<div class="gardeneer_catd_action_grid_action_itm  user_select">'.$elem[$el].'</div>';
                }
                $gener_div .= '
                    <div class="gardeneer_catd_action_grid_action">  
                        '.$gener_str.'
                    </div>
                ';
            }

            return  '<div class="gardeneer_catd_action_grid_header">
                    '.$head.'
                </div>
                <div class="table_elem_form">
                    '.$gener_div.'
                </div>';
        }
        public function render($name,$get_link,$get_sql,$get_fields,$get_names){
        return  '
            <form class="modal_service modal_redactor" id="modal_service">
                <div class="main_panel">
                    <div class="left">
                        <div class="fio_type margin-right_45px">
                            <span class="fio font__25 user_select">'.$name.'</span>
                        </div>
                    </div>
                    <div class="right">
                        <div class="close_x">
                            <i class="fa fa-times close_x" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="menu_button">   
                    <div class="button_left">
                        <button class="catd_action_item button_change_in_modal" disabled>
                            <span class="font__14 user_select">Изменить</span>
                        </button>
                        <div class="catd_action_item create_modal">
                             <span class="font__14 user_select create_modal">Создать</span>
                        </div>
                        <div class="catd_action_item">
                            <span class="font__14 user_select">Создать группу</span>
                        </div>
                        <div class="catd_action_item">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </div>
                        <div class="catd_action_item">
                            <span class="font__14 user_select">Найти..</span>
                        </div>
                        <div class="catd_action_item">
                            <span class="font__14 user_select"><button disabled>Отменить поиск</button> </span>
                         </div>
                    </div>
                </div>
                <div class="support_table">
                    '.$this->get_table_content($get_link,$get_sql,$get_fields,$get_names).'
                </div>
            </form>'; }
}
$service = new Window_support;
$service_sql = '
SELECT * FROM services
';
if($_POST['service'] == 'Услуги'){
    echo $service->render($_POST['service'],$link,$service_sql,$_POST['sql_keys'],$_POST['columns_table']);
}
$tariff_sql = '
SELECT * FROM tariffs
';
if($_POST['service'] == 'Услуги и тарифы'){
    echo $service->render($_POST['service'],$link,$tariff_sql,$_POST['sql_keys'],$_POST['columns_table']);
}

