const intelligence_list = document.querySelectorAll('.intelligence_item');
const intelligence_list_get = location.search;
let param = new URLSearchParams(intelligence_list_get);
let intelligence_list_get_int = 0;

if (param.get('number') != null) {
    intelligence_list_get_int = parseInt(param.get('number'));
}
intelligence_list.forEach(elem => {
    if (elem.classList.contains('active')) {
        elem.classList.remove('acrive');
    }
});
intelligence_list[intelligence_list_get_int].classList.add('active');

function modal_functional() {
    const inp_elem = document.querySelectorAll('.modal_select_list');
    $(document).keydown(e => {
        if (e.key == 'Escape') {
            inp_elem.forEach(elem => {
                $(elem).css({
                    "display": "none"
                });
            });
        }
    });
    document.querySelectorAll('.modal_redactor').forEach(elem => {
        $(elem).click(function (e) {
            if (e.target.classList.contains('close_form') || e.target.classList.contains('close_x')) {
                inp_elem.forEach(elem => {
                    elem.style.display = "none";
                })
                const id = '#' + this.id;
                $(id).remove();
                const modals = document.querySelectorAll('.modal_redactor');
                if (modals.length > 0) {
                    $(modals[modals.length - 1]).css({
                        'pointer-events': 'auto'
                    });
                } else {
                    $('body').css({
                        'pointer-events': 'auto'
                    });
                }

            }
            if (e.target.classList.contains('open_arrow')) {
                e.stopImmediatePropagation();
                const father_arrow = e.target.parentNode;
                if (getComputedStyle(father_arrow.querySelector('.modal_select_list')).display == "none") {
                    inp_elem.forEach(elem => {
                        elem.style.display = "none";
                    })
                    $(father_arrow).find('.modal_select_list').css({
                        "display": "block"
                    });
                } else {
                    $(father_arrow).find('.modal_select_list').css({
                        "display": "none"
                    });
                }
            } else {
                inp_elem.forEach(elem => {
                    elem.style.display = "none";
                })
            }
            if (e.target.classList.contains('modal_action_inp_item')) {
                const father_inp_item = e.target.parentNode.parentNode;
                if ($(e.target).attr('data-indx')) {
                    $(father_inp_item).find('.modal_action_item').attr('data-search', $(e.target).attr('data-indx'));
                }
                $(father_inp_item).find('.modal_action_item').attr('value', e.target.innerHTML);
            }
        });

    });
    //оброботчик всех ... для таблицы услуги
    document.querySelectorAll('.modal_action_inp_item').forEach(elem => {
        $(elem).mouseover(() => {
            document.querySelectorAll('.modal_action_inp_item').forEach(element => {
                if ($(element).hasClass('select_item_active')) {
                    $(element).removeClass('select_item_active')
                }
            })
            $(elem).addClass('select_item_active');
        })
    })
}

function move(e) {
    if (!e.target.classList.contains('no_target')) {
        this.style.left = e.pageX - this.offsetWidth / 2 + 'px';
        this.style.top = e.pageY - this.offsetHeight / 2 + 'px';
    }
}

function mousedown(e) {
    if (!e.target.classList.contains('no_target')) {
        this.addEventListener('mousemove', move);
    }
    if (e.target.classList.contains('modal_save_close')) {
        localStorage.setItem('accurals_close', '1');
    }
    if (e.target.classList.contains('modal_save') && e.target.parentElement.parentElement.parentElement.classList.contains('modal_redactor_close')) {
        localStorage.setItem('accurals_close', '2');
    }
    if (e.target.classList.contains('modal_save') && e.target.parentElement.parentElement.parentElement.classList.contains('modal_change')) {
        localStorage.setItem('modal_change', '1');
    }
}

function mouseup() {
    this.removeEventListener('mousemove', move);
}

function search() {
    //поиск по таблице
    $('div[data-status="search"]').click(function () {
        const search_header = $(this).parents().eq(2).find('.gardeneer_catd_action_grid_header_items');
        let header_list = [];
        $.map(search_header, elem => {
            header_list.push(elem.innerText);
        });
        const this_button = $(this);
        $.post('/php/gardeneers/gardeneer_card/modals/modal_search.php', {
            header_list: header_list
        }, function (data) {
            if ($('main').children().last().hasClass('modal_redactor')) {
                $('main').children().last().css({
                    "pointer-events": "none"
                });
            } else {
                $('body').css({
                    "pointer-events": "none"
                });
            }
            $('main').append($.parseHTML(data));
            $(document).ajaxComplete(function () {
                const search = document.getElementById('search');
                search.addEventListener('mousedown', mousedown);
                search.addEventListener('mouseup', mouseup);
                modal_functional();
                $('#search').css({
                    "pointer-events": "auto"
                });
                $(search).find('input').on('change', function () {
                    if ($(this).val() != '') {
                        $(this).css({
                            "box-shadow": "0 0 2px #00000080",
                            "border": "#524c4c7d"
                        });
                    }
                });
                //механизм поиска
                $('div[data-but="search"]').click(() => {
                    if ($('input[name="search_param"]').val() == '' || $('input[name="search_content"]').val() == '') {
                        if ($('input[name="search_param"]').val() == '') {
                            $('input[name="search_param"]').css({
                                "border": "2px solid red"
                            });
                        }
                        if ($('input[name="search_content"]').val() == '') {
                            $('input[name="search_content"]').css({
                                "border": "2px solid red"
                            });
                        }
                    } else {
                        let search_flag = false;
                        const table_content = $(search_header).parent().next().find('.gardeneer_catd_action_grid_action');
                        const column_id = parseInt($('input[name="search_param"]').attr('data-search'));
                        $.map(table_content, elem => {
                            if (elem.children[column_id].innerText.search(new RegExp($('input[name="search_content"]').val(), 'i')) != -1) {
                                search_flag = true;
                                elem.classList.add('select_item_active');
                            }
                        });
                        if (search_flag) {
                            $('#search').remove();
                            if ($('main').children().last().hasClass('modal_redactor')) {
                                $('main').children().last().css({
                                    "pointer-events": "auto"
                                });
                            } else {
                                $('body').css({
                                    "pointer-events": "auto"
                                });
                            }
                            $(this_button).next().removeAttr('disabled');
                        }
                    }
                });
            });
        });
    });

    $('button[data-status="cancel_search"]').click(function () {
        const canceled = $(this).parents().eq(2).find('.select_item_active');
        $.map(canceled, elem => {
            elem.classList.remove('select_item_active');
        });
        $(this).attr('disabled', 'true');
    });
}
search();
// Работа с модальными окнами и всем контентом вкладки начисления
if (param.get('number') == '1') {
    calculate_width_scroll();
    const item_main = document.querySelector('.gardeneer_catd_action_all').querySelectorAll('.gardeneer_catd_action_grid_action'); //получение всех строк таблицы через класс родителя
    const del_button = document.querySelector('.del_elem'); //кнопка удалить
    const accural_change_button = document.querySelector('.modal_change_button'); //кнопка изменить
    let del_elem = ''; //запись дата атрибута для отправки на сервер для удаления
    let del_elems = ''; //запись всех дата атрибута для отправки на сервер для удаления

    function modal_change_tabs() {
        const tabs = document.querySelectorAll('.make_service_main_button');
        tabs.forEach((elem, index) => {
            elem.addEventListener('click', () => {
                tabs.forEach(element => {
                    if (element.classList.contains('active_servise_button')) {
                        element.classList.remove('active_servise_button');
                    }
                });
                elem.classList.add('active_servise_button');
                const item_activ = document.querySelectorAll('.modal_tab');
                if (index == 0) {
                    item_activ[0].style.display = "block";
                    item_activ[1].style.display = "none";
                }
                if (index == 1) {
                    item_activ[1].style.display = "block";
                    item_activ[0].style.display = "none";
                }
            });
        });
    }

    function click_string_table() {
        const string_in_table = document.querySelectorAll('.gardeneer_catd_action_grid_action');
        string_in_table.forEach(elem => {
            $(elem).click(() => {
                const elem_class = $(elem).parent().attr('class');
                string_in_table.forEach(element => {
                    if (elem_class == $(element).parent().attr('class') && $(element).hasClass('select_item_active')) {
                        $(element).removeClass('select_item_active');
                    }
                })
                $(elem).addClass('select_item_active');
                del_button.removeAttribute('disabled');
                if ($(elem).parents().eq(2).hasClass('gardeneer_catd_action_all')) {
                    accural_change_button.removeAttribute('disabled');
                } else {
                    const button_change_in_modal = document.querySelector('.button_change_in_modal');
                    button_change_in_modal.removeAttribute('disabled');
                    $(button_change_in_modal).addClass('active');
                }
            })
            $(elem).dblclick(() => {
                if ($(elem).parents().eq(2).hasClass('modal_service')) {
                    $('input[name="service"]').val($(elem).children(':first').html());
                    $(elem).parents().eq(2).remove();
                    $('main').children(':last').css({
                        "pointer-events": "auto"
                    });
                }
            });
        })
    }

    function get_active_button() {
        document.querySelectorAll('.make_service_main_button').forEach(elem => {
            elem.addEventListener('click', () => {
                document.querySelectorAll('.make_service_main_button').forEach(element => {
                    if (element.classList.contains('active_servise_button')) {
                        element.classList.remove('active_servise_button');
                    }
                })
                elem.classList.add('active_servise_button');
                const menu_table = document.querySelectorAll('.make_service_date_write');
                if (elem.classList.contains('active_servise_button') && elem.classList.contains('left')) {
                    menu_table[0].style.display = "block";
                    menu_table[1].style.display = "none";
                }
                if (elem.classList.contains('active_servise_button') && elem.classList.contains('right')) {
                    menu_table[1].style.display = "block";
                    menu_table[0].style.display = "none";
                }
            })
        })
    }

    function modal_create_service() {
        $('.create_modal').click(function (e) {
            e.stopImmediatePropagation();
            if ($('.create_modal').parents().eq(3).find('.fio').html() == 'Услуги') {
                $.post('/php/gardeneers/gardeneer_card/modals/service_create_modal.php', {
                    a: 'a'
                }, function (data) {
                    $('main').append($.parseHTML(data));
                })
                $(document).ajaxComplete(function () {
                    const service_create_modal = document.querySelector('.service_create_modal');
                    service_create_modal.addEventListener('mousedown', mousedown);
                    service_create_modal.addEventListener('mouseup', mouseup);
                    $(service_create_modal).css({
                        "pointer-events": "auto"
                    });
                    $(this).parents().eq(2).css({
                        'pointer-events': 'none'
                    });
                    modal_functional();
                    modal_change_tabs()
                });
            }
            if ($('.create_modal').parents().eq(3).find('.fio').html() == 'Услуги и тарифы') {
                $.post('/php/gardeneers/gardeneer_card/modals/modal_add_serviсe_tariff.php', {
                    a: 'a'
                }, function (data) {
                    $('main').append($.parseHTML(data));
                });
                $(document).ajaxComplete(function () {
                    const add_serviсe_tariff = document.querySelector('.add_serviсe_tariff');
                    add_serviсe_tariff.addEventListener('mousedown', mousedown);
                    add_serviсe_tariff.addEventListener('mouseup', mouseup);
                    $(add_serviсe_tariff).css({
                        "pointer-events": "auto"
                    });
                    $(this).parents().eq(2).css({
                        'pointer-events': 'none'
                    });
                    modal_functional();
                });
            }
        });
    }

    function create_window_support(name, keys, columns) {
        $.post('/php/modal_universal/window_support.php', {
            service: name,
            sql_keys: keys,
            columns_table: columns
        }, data => {
            $('main').append($.parseHTML(data));
        })
        $(document).ajaxComplete(function () {
            const modal_service = document.querySelector('.modal_service');
            $(modal_service).css({
                'pointer-events': 'auto'
            });
            modal_service.addEventListener('mousedown', mousedown);
            modal_service.addEventListener('mouseup', mouseup);
            modal_functional();
            click_string_table();
            modal_create_service()
            $(this).parents().eq(3).css({
                'pointer-events': 'none'
            });
        });
    }

    function modal_services() {
        document.querySelectorAll('div[data-select="services"]').forEach(elem => {
            $(elem).click(() => {
                create_window_support.apply(elem, ['Услуги', ['service_name', 'id_service'],
                    ['Наименование', 'Код']
                ])
            });
        });
        document.querySelectorAll('div[data-select="tariff"]').forEach(elem => {
            $(elem).click(() => {
                create_window_support.apply(elem, ['Услуги и тарифы', ['tariff_name', 'id_tariff', 'price', 'count_unit'],
                    ['Наименование', 'Код', 'Цена', 'Единица учета']
                ]);
                $(document).ajaxComplete(function () {
                    $('.modal_service').addClass('servise_tarif');
                })
            });
        });
    }

    function add_accrual() {
        $.post('/php/gardeneers/gardeneer_card/modals/add_accrual.php', {
            FIO: $(this).find('input[name="FIO"]').val() || '',
            service: $(this).find('input[name="service"]').val(),
            tarif: $(this).find('input[name="tarif"]').val(),
            calc_unit: $(this).find('input[name="calc_unit"]').val(),
            count_status: $(this).find('input[name="count_status"]').val(),
            date_create: $(this).find('input[name="date_create"]').val(),
            code: $(this).attr('data-code')
        }, function (data) {
            location.href = location.href;
        })
    }
    //Вызов модального окна создание начисления
    function modal_create_accrual() {
        $.post('/php/gardeneers/gardeneer_card/modals/modal_accrual_add.php', {
            FIO: param.get('name')
        }, function (data) {
            $('main').append($.parseHTML(data));
        })
        $('body').css({
            "pointer-events": "none"
        });
    }

    function create_accrual_functional() {
        const modal_redactor = document.querySelectorAll('form[data-code]');
        modal_redactor.forEach(elem => {
            elem.addEventListener('mousedown', mousedown);
            elem.addEventListener('mouseup', mouseup);
            elem.style.cssText = "pointer-events:auto;";
            modal_functional();
            modal_services();
            $(elem).find('.modal_save_close').click(function (event) {
                event.stopImmediatePropagation();
                add_accrual.apply(elem);
                localStorage.removeItem('modal_create_accrual');
            });
            $(elem).find('.modal_save').click(function (event) {
                event.stopImmediatePropagation();
                localStorage.setItem('modal_create_accrual', '1');
                add_accrual.apply(elem);
            })
        });
    }
    click_string_table();
    if (localStorage.getItem('modal_create_accrual') == '1') {
        modal_create_accrual();
        $(document).ajaxComplete(function () {
            create_accrual_functional();
        });
    }

    $('.add_form').click(() => {
        modal_create_accrual();
        $(document).ajaxComplete(function () {
            create_accrual_functional();
        });
    });

    //кнопка выделить всё
    $('.marker_elem').click(() => {
        item_main.forEach(elem => {
            elem.classList.add('select_item_active');
        });
        if (item_main.length != 0) {
            del_button.removeAttribute('disabled');
            del_elems = item_main[0].dataset.codeall;
        }
    });

    //кнопка отменить выделение
    $('.dont_marker_elem').click(() => {
        item_main.forEach(elem => {
            elem.classList.remove('select_item_active');
        });
        del_button.setAttribute('disabled', true);
        accural_change_button.setAttribute('disabled', true);
    });
    //кнопка удалить
    $(del_button).click(() => {
        if (del_elems == '') {
            item_main.forEach(elem => {
                if (elem.classList.contains('select_item_active')) {
                    del_elem = elem.dataset.code;
                }
            });
        }
        $.post('/php/gardeneers/gardeneer_card/modals/remove_accrual.php', {
            del_elem: del_elem,
            del_elems: del_elems
        }, function (data) {

            console.log('delete_success'); // ответ от сервера
        })
        location.href = location.href;
    });
    //модальное окно "Изменить"
    accural_change_button.addEventListener('click', () => {
        let id_accrual = '';
        item_main.forEach(elem => {
            if (elem.classList.contains('select_item_active')) {
                id_accrual = elem.dataset.code;
            }
        })
        $.post('/php/gardeneers/gardeneer_card/modals/modal_change_accrual.php', {
            id_accrual: id_accrual
        }, function (data) {
            $('main').append($.parseHTML(data));
        });
        $(document).ajaxComplete(function () {
            const modal_change_accrual = document.querySelector('.modal_change');
            modal_change_accrual.addEventListener('mousedown', mousedown);
            modal_change_accrual.addEventListener('mouseup', mouseup);
            modal_functional();
            modal_change_tabs();
            create_accrual_functional();
            search();
        });
    });

}
if (param.get('number') == '2') {
    const left_form = document.querySelector('.left_form');
    left_form.querySelectorAll('.gardeneer_catd_action_grid_action').forEach((element, index) => {
        element.addEventListener('click', () => {
            const id_counter = element.children[1].innerHTML;
            const name = document.querySelector('.fio').innerHTML;
            document.location.href = 'http://manager/php/gardeneers/gardeneer_card/card_page.php?id_counter=' + id_counter + '&order=' + index + '&name=' + name + '&number=' + param.get('number');
        });
    })
    if (param.get('order') != null) {
        const temp = parseInt(param.get('order'));
        left_form.querySelectorAll('.gardeneer_catd_action_grid_action')[temp].classList.add('select_item_active');
    } else {
        left_form.querySelectorAll('.gardeneer_catd_action_grid_action')[0].classList.add('select_item_active');
    }
    $('.create_counter').click(() => {
        $.post('/php/gardeneers/gardeneer_card/create/create_counter.php', {
            plot_number: param.get('name')
        }, function (data) {
            $('main').children().remove();
            $('main').append($.parseHTML(data));
        });
        $(document).ajaxComplete(function () {
            $('html').css({
                "overflow": "auto"
            });
            $('.close_x').click(() => {
                location.href = location.href;
            })
        })
    })
    $('.indications_counters').click(() => {
        const id_counter = $('.select_item_active').children().eq(1).html();
        $.post('/php/gardeneers/gardeneer_card/modals/counters_indications.php', {
            id_counter: id_counter
        }, function (data) {
            $('main').children().remove()
            $('main').append($.parseHTML(data));
            $(document).ajaxComplete(function () {
                $('html').css({
                    "overflow": "auto"
                });
                $('.close_x').click(() => {
                    location.href = location.href;
                })
            });
        })
    })
}

if (param.get('number') == '3') {
    let sum_recalc = 0;
    let sum_payment = 0;
    let sum_final_balance = 0;

    document.querySelectorAll('.count').forEach(elem => {
        if (elem.children[4].innerHTML == '') {
            elem.children[4], innerHTML = 0;
        } else {
            sum_recalc += parseInt(elem.children[4].innerHTML);
        }
        if (elem.children[5].innerHTML == '') {
            elem.children[5].innerHTML = 0;
        } else {
            sum_payment += parseInt(elem.children[5].innerHTML);
        }
        if (elem.children[6].innerHTML == '') {
            elem.children[6].innerHTML = 0;
        } else {
            sum_final_balance += parseInt(elem.children[6].innerHTML);
        }
    });
    document.querySelectorAll('.calculations')[0].innerHTML = '= ' + sum_recalc;
    document.querySelectorAll('.calculations')[1].innerHTML = '= ' + sum_payment;
    document.querySelectorAll('.calculations')[2].innerHTML = '= ' + sum_final_balance;
}