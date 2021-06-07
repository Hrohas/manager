const gardeneers_buttons_list = document.querySelectorAll('.main_servises_itm');
const gardeneers_buttons_list_get = location.search;
let params = new URLSearchParams(gardeneers_buttons_list_get);
let gardeneers_buttons_list_get_int = 0;
if (params.get('gardeneers_button_number') != null) {
    gardeneers_buttons_list_get_int = parseInt(params.get('gardeneers_button_number'));
}
gardeneers_buttons_list.forEach(elem => {
    if (elem.classList.contains('main_active')) {
        elem.classList.remove('main_active');
    }
});
gardeneers_buttons_list[gardeneers_buttons_list_get_int].classList.add('main_active');

document.querySelectorAll('.gardeneer_catd_action_grid_action').forEach(elem => {
    elem.addEventListener('click', () => {
        document.querySelectorAll('.gardeneer_catd_action_grid_action').forEach(element => {
            if (element.classList.contains('select_item_active')) {
                element.classList.remove('select_item_active');
            }
        });
        elem.classList.add('select_item_active');
    })
    elem.addEventListener('dblclick', () => {
        const elem_name = elem.firstElementChild.innerHTML;
        const url = 'http://manager/php/gardeneers/gardeneer_card/card_page.php?name=' + elem_name;
        document.location.href = url;
    });
});