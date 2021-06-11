<?php
    $list_items = '';
    foreach($_POST['header_list'] as $elem) {
        $list_items .= '<div class="modal_action_inp_item font__11 no_target">'.$elem.'</div>';
    }
    echo '
    <div class="modal_search modal_redactor" id="search">
    <div class="modal_name_close">
        <span class="moda_text font__25 no_target">Найти</span>
        <div class="close_x"><i class="fa fa-times close_form no_target modal_save_close" aria-hidden="true"
                id="test"></i></div>
    </div>
    <div class="modal_action_down font__14 no_target">
        <div class="modal_action_left no_target">
            <div class="modal_action_item">Где искать:</div>
            <div class="modal_action_item">Что искать:</div>
        </div>
        <div class="modal_action_right no_target">
            <div class="modal_action_inp">
                <input type="text" class="modal_action_item no_target" name="tarif">
                <i class="fa fa-arrow-down open_arrow" aria-hidden="true" style="right:0;top: 0px;"></i>
                <div class="modal_action_inp_elem no_target modal_select_list" style="display: none;">
                    '.$list_items.'
                </div>
            </div>
            <div class="modal_action_inp no_target no_target">
                <input type="text">
            </div>
        </div>
    </div>
    <div class="down_button">
        <div class="down_button_item active font__14">Найти</div>
        <div class="down_button_item close_form font__14">Закрыть</div>
    </div>
    </div>
    ';
?>