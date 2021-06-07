<?php

echo ' <div class="help_create_counter">
 <div class="main_panel">
     <div class="main_panel_left">
         <div class="fio_type margin-right_45px">
             <span class="fio font__25">Помощник создания счетчиков</span>
         </div>
     </div>
     <div class="close close_x">
         <i class="fa fa-times close_x" aria-hidden="true"></i>
     </div>
 </div>
 <div class="main_panel_left main_panel_button">
     <div class="main_action active font__14">Добавить</div>
 </div>
 <div class="input_flex">
     <div class="modal_action_down font__14 no_target">
         <div class="modal_action_left no_target">
             <div class="modal_action_item font__14">Шаблон счетчика:</div>
             <div class="modal_action_item font__14" style="margin-top: 20px;">Участки:</div>
         </div>
         <div class="modal_action_right no_target">
             <div class="modal_action_inp">
                 <div class="modal_action_inp no_target">
                     <input type="text" class="modal_action_item no_target litle_padding">
                     <i class="fa fa-arrow-down open_arrow" aria-hidden="true" style="right:0;top:11px;"></i>
                     <div class="modal_action_inp_elem no_target modal_select_list" style="display: none;">
                         <div class="modal_action_inp_item no_target font__11"></div>
                     </div>
                 </div>
             </div>
             <div class="modal_action_inp no_target">
                 <input class="input_without_block" type="text" class="modal_action_item no_target">
                 <div class="many_point no_target" data-select="tariff" style="padding: 4px 6px;">...</div>
             </div>
         </div>
     </div>
     <div class="modal_action_down font__14 no_target" style="margin-left: 8px;">
         <div class="modal_action_left no_target">
             <div class="modal_action_item font__14 ">Наименование:</div>
         </div>
         <div class="modal_action_right no_target">
             <div class="modal_action_inp">
                 <input class="input_without_block" type="text" class="modal_action_item no_target" name="tarif">
             </div>
         </div>
     </div>
 </div>
 <div class="type_name">Вид показаний</div>
 <div class="main_panel_left main_panel_button">
     <div class="help_create_counter_button">
         <div class="main_action font__14">Добавить</div>
     </div>
     <div class="button_arrow">
         <div class="button_main_items arrow_one"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
         <div class="button_main_items arrow_two"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
     </div>
 </div>
 <div class="add_serviсe_tariff_table" style="margin-bottom: 13px;">
     <div class="gardeneer_catd_action_grid_header">
         <div class="gardeneer_catd_action_grid_header_items  user_select">Вид показаний</div>
         <div class="gardeneer_catd_action_grid_header_items  user_select">Разрядность показаний</div>
         <div class="gardeneer_catd_action_grid_header_items  user_select">Единица учета</div>
         <div class="gardeneer_catd_action_grid_header_items  user_select">Начальные показания</div>
     </div>
     <div class="table_elem_form">
         <div class="gardeneer_catd_action_grid_action">
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
         </div>
     </div>
 </div>
 <div class="type_name">Виды расчетов</div>
 <div class="main_panel_left main_panel_button">
     <div class="help_create_counter_button">
         <div class="main_action font__14">Добавить</div>
     </div>
     <div class="button_arrow">
         <div class="button_main_items arrow_one"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
         <div class="button_main_items arrow_two"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
     </div>
 </div>
 <div class="add_serviсe_tariff_table down_table">
     <div class="gardeneer_catd_action_grid_header">
         <div class="gardeneer_catd_action_grid_header_items  user_select">Вид расчета</div>
         <div class="gardeneer_catd_action_grid_header_items  user_select">Вид показаний</div>
         <div class="gardeneer_catd_action_grid_header_items  user_select">Единица расчета нормативного
             колличества</div>
     </div>
     <div class="table_elem_form">
         <div class="gardeneer_catd_action_grid_action">
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
             <div class="gardeneer_catd_action_grid_action_itm  user_select"></div>
         </div>
     </div>
 </div>
</div>';