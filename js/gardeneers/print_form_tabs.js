const print_form = [
    `
    <div class="button_services">
    <div class="button_services_left">
        <div class="button_main_items user_select font__14 ">Добавить новый элемент
        </div>
        <div class="button_main_items user_select font__14 ">Сгрупперовать условия
        </div>
        <button class="button_main_items user_select font__14 "
            disabled="disabled">Удалить</button>
        <div class="button_arrow">
            <div class="button_main_items arrow_one"><i class="fa fa-arrow-up"
                    aria-hidden="true"></i></div>
            <div class="button_main_items arrow_two"><i class="fa fa-arrow-down"
                    aria-hidden="true"></i></div>
        </div>
        <button class="button_main_items user_select font__14 "
            disabled="disabled">Свойства
            элемента пользовательских настроек</button>
    </div>
    <div class="button_main_rigt">
        <div class="button_main_items user_select font__14 ">Ещё</div>
    </div>
</div>
<div class="gardeneer_catd_action_all">
    <div class="gardeneer_catd_action_grid_header grid_action">
        <div class="gardeneer_catd_action_grid_header_items user_select"></div>
        <div class="gardeneer_catd_action_grid_header_items user_select">
            Поле</div>
        <div class="gardeneer_catd_action_grid_header_items user_select">Вид
            сравнения</div>
        <div class="gardeneer_catd_action_grid_header_items user_select">Значения
        </div>
    </div>
    <!--Убрать бордер ботем у .gardeneer_catd_action_grid_action_itm и добавить его .gardeneer_catd_action_grid_action_sub-->
    <div class="gardeneer_catd_action_grid_action grid_action">
        <div class="gardeneer_catd_action_grid_action_itm user_select"></div>
        <div class="gardeneer_catd_action_grid_action_itm user_select"><i
                class="fa fa-minus-circle"
                aria-hidden="true"></i></i><span>Обзор</span></div>
    </div>
    <div class="gardeneer_catd_action_grid_action_sub grid_action">
        <div class="gardeneer_catd_action_grid_action_itm  user_select none_style">
            <input type="checkbox"></div>
        <div class="gardeneer_catd_action_grid_action_itm sub font__14 user_select">
            <div class="minus"><i class="fa fa-minus" aria-hidden="true"></i></div>
            Карточки садовода
        </div>
        <div class="gardeneer_catd_action_grid_action_itm user_select">Равно</div>
        <div class="gardeneer_catd_action_grid_action_itm user_select"></div>
        <div class="gardeneer_catd_action_grid_action_itm  user_select none_style">
            <input type="checkbox"></div>
        <div class="gardeneer_catd_action_grid_action_itm sub font__14 user_select">
            <div class="minus"><i class="fa fa-minus" aria-hidden="true"></i></div>
            Карточки садовода
        </div>
        <div class="gardeneer_catd_action_grid_action_itm user_select">Равно</div>
        <div class="gardeneer_catd_action_grid_action_itm user_select"></div>
        <div class="gardeneer_catd_action_grid_action_itm  user_select none_style">
            <input type="checkbox"></div>
        <div class="gardeneer_catd_action_grid_action_itm sub font__14 user_select">
            <div class="minus"><i class="fa fa-minus" aria-hidden="true"></i></div>
            Карточки садовода
        </div>
        <div class="gardeneer_catd_action_grid_action_itm user_select">Равно</div>
        <div class="gardeneer_catd_action_grid_action_itm user_select"></div>
    </div>
</div>`,
    `<div class="order">
    <div class="button_services">
        <div class="button_services_left">
            <div class="button_main_items user_select font__14 ">Добавить новый
                элемент
            </div>
            <div class="button_main_items user_select font__14 ">Сгрупперовать
                условия
            </div>
            <button class="button_main_items user_select font__14 "
                disabled="disabled">Удалить</button>
            <div class="button_arrow">
                <div class="button_main_items arrow_one"><i class="fa fa-arrow-up"
                        aria-hidden="true"></i></div>
                <div class="button_main_items arrow_two"><i class="fa fa-arrow-down"
                        aria-hidden="true"></i></div>
            </div>
            <button class="button_main_items user_select font__14 "
                disabled="disabled">Свойства
                элемента пользовательских настроек</button>
        </div>
        <div class="button_main_rigt">
            <div class="button_main_items user_select font__14 ">Ещё</div>
        </div>
    </div>
    <div class="gardeneer_catd_action_all">
        <div class="gardeneer_catd_action_grid_header grid_action">
            <div class="gardeneer_catd_action_grid_header_items user_select"></div>
            <div class="gardeneer_catd_action_grid_header_items user_select">
                Поле</div>
            <div class="gardeneer_catd_action_grid_header_items user_select">Направление сортировки
                сравнения</div>
        </div>
        <!--Убрать бордер ботем у .gardeneer_catd_action_grid_action_itm и добавить его .gardeneer_catd_action_grid_action_sub-->
        <div class="gardeneer_catd_action_grid_action grid_action">
                <div class="gardeneer_catd_action_grid_action_itm  user_select none_style">
                <input type="checkbox"></div>
                <div class="gardeneer_catd_action_grid_action_itm sub font__14 user_select">
                    <div class="minus"><i class="fa fa-minus" aria-hidden="true"></i>
                    </div>
                    Карточки садовода
                </div>
                <div class="gardeneer_catd_action_grid_action_itm sub font__14 user_select">
                    По возростанию
                </div>
    </div>
</div>`
];

document.querySelectorAll('.main_servises_itm')[6].addEventListener('click', () => {
    document.querySelector('.button_services_container').innerHTML = print_form[0];
    const order_items = document.querySelector('.sortiration_order').children;
    for (let g = 0; g < order_items.length; g++) {
        order_items[g].addEventListener('click', () => {
            document.querySelector('.button_services_container').innerHTML = print_form[g];
            const button = document.querySelector('.sortiration_order').children;
            for (let i = 0; i < button.length; i++) {
                if (button[i].classList.contains('active_item_form')){
                    button[i].classList.add('sortiration_order_item');
                    button[i].classList.remove('active_item_form');
                }
            }
            order_items[g].classList.remove('sortiration_order_item');
            order_items[g].classList.add('active_item_form');
        });
    }
});