<?php
echo 
'<div class="add_serviсe_tariff main_padding modal_redactor">
<div class="main_panel">
    <div class="main_panel_left">
        <div class="fio_type margin-right_45px">
            <span class="fio font__25">Добавление услуг и тарифов</span>
        </div>
    </div>
    <div class="close_x">
        <i class="fa fa-times close_x" aria-hidden="true"></i>
    </div>
</div>
<div class="main_panel_left main_panel_button">
    <div class="main_action active font__14">Создать и закрыть</div>
    <div class="main_action font__14">Закрыть</div>
</div>
<div class="add_serviсe_tariff_table">
    <div class="gardeneer_catd_action_grid_header">
        <div class="gardeneer_catd_action_grid_header_items  user_select">Шаблоны</div>
    </div>
    <div class="table_elem_form">
        <div class="gardeneer_catd_action_grid_action">
            <div class="gardeneer_catd_action_grid_action_itm  user_select"><i class="fa fa-minus-circle"
                    aria-hidden="true"></i> Газоснобжение</div>
        </div>
        <div class="gardeneer_catd_action_grid_action_sub">
            <div class="gardeneer_catd_action_grid_action_itm sub font__14 user_select">Газоснобжение по
                приборам учета</div>
        </div>
    </div>
</div>
<div class="add_serviсe_tariff_informer">
    <span class="who_service">Расчет начислений за Газоснобжение.</span>
    <span class="inform">Расчет производится по показаниям приборов учета.</span>
</div>
<div class="add_serviсe_tariff_check">
    <input type="radio" name="create_service" id="create_service">
    <label for="create_service">Создать услугу</label>
    <input type="radio" name="choice_servie" id="choice_servie">
    <label for="choice_servie">Выбрать услугу</label>
    <input type="radio" name="choice_servie_existing" id="choice_servie_existing">
    <label for="choice_servie_existing">Выбрать существующую услугу без отбора</label>
</div>
<div class="modal_action_down font__14 no_target">
    <div class="modal_action_left no_target">
        <div class="modal_action_item">Наименование услуги:</div>
        <div class="modal_action_item">Наименование тарифа:</div>
    </div>
    <div class="modal_action_right no_target">
        <div class="modal_action_inp">
            <input class="input_without_block" type="text" class="modal_action_item no_target" name="tarif">
        </div>
        <div class="modal_action_inp no_target no_target">
            <input class="input_without_block" type="text" class="modal_action_item no_target" name="calc_unit">
        </div>
    </div>
</div>
<div class="add_serviсe_tariff_calc_unit font__14">
    <div class="modal_action_down font__14 no_target">
        <div class="modal_action_left no_target">
            <div class="calc_unit_text">Наименование услуги:</div>
        </div>
        <div class="modal_action_right no_target">
            <div class="modal_action_inp">
                <input type="text" class="modal_action_item no_target" name="tarif">
                <i class="fa fa-arrow-down open_arrow" aria-hidden="true" style="right:0;top: 0px;"></i>
            </div>
        </div>
    </div>
    <div class="modal_action_down left_form font__14 no_target">
        <div class="modal_action_left no_target">
            <div class="calc_unit_text">Наименование услуги:</div>
        </div>
        <div class="modal_action_right  no_target">
            <div class="modal_action_inp">
                <input type="text" class="modal_action_item no_target" name="tarif">
                <i class="fa fa-calculator open_arrow" aria-hidden="true" style="right:0;top:1px;"></i>
            </div>
        </div>
    </div>
</div>
</div>';