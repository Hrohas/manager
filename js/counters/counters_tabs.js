const search_url_get = location.search;
const params = new URLSearchParams(search_url_get);
const button = document.querySelectorAll('.main_servises_itm');
if(params.get('count_button_number') == null){
    button[0].classList.add('main_active');
}else{
    
    button[parseInt(params.get('count_button_number'))].classList.add('main_active');
}

if (params.get('count_button_number') == '0') {
    document.querySelector('.forms_gardeenier_cart').querySelectorAll('.gardeneer_catd_action_grid_action').forEach((elem, index) => {
        elem.addEventListener('click', () => {
            const id_gardeneer = elem.querySelector('input').value;
            document.location.href = 'http://manager/count.php?count_button_number=0' + '&id_gardeneer=' + id_gardeneer + '&index_gardeneer=' + index + '&count_button_number=0';
        })
    })
    const search_url = document.querySelector('.forms_gardeenier_cart').querySelectorAll('.gardeneer_catd_action_grid_action');

    let count_gardaeer_get = 0;
    if (params.get('index_gardeneer') != null) {
        count_gardaeer_get = parseInt(params.get('index_gardeneer'));
    }
    search_url.forEach(elem => {
        if (elem.classList.contains('select_item_active')) {
            elem.classList.remove('select_item_active');
        }
    });
    search_url[count_gardaeer_get].classList.add('select_item_active');

    document.querySelector('.forms_counts').querySelectorAll('.gardeneer_catd_action_grid_action').forEach((elem, index) => {
        elem.addEventListener('click', () => {
            const id_count = elem.children[2].innerHTML;
            document.location.href = 'http://manager/count.php?count_button_number=0' + '&id_counter=' + id_count + '&index_counter=' + index + '&index_gardeneer=' + count_gardaeer_get;
        })
    })

    const search_url_count = document.querySelector('.forms_counts').querySelectorAll('.gardeneer_catd_action_grid_action');
    let count_tabs = 0;
    if (params.get('index_counter') != null) {
        count_tabs = parseInt(params.get('index_counter'));
    }
    search_url_count.forEach(elem => {
        if (elem.classList.contains('select_item_active')) {
            elem.classList.remove('select_item_active');
        }
    })
    search_url_count[count_tabs].classList.add('select_item_active');
}
if (params.get('count_button_number') == '1' || params.get('count_button_number') == '2' || params.get('count_button_number') == '3') {
    const forms_up = document.querySelector('.forms_up').querySelectorAll('.gardeneer_catd_action_grid_action');
    forms_up.forEach(elem => {
        elem.addEventListener('click', () => {
            forms_up.forEach(element => {
                if (element.classList.contains('select_item_active')) {
                    element.classList.remove('select_item_active');
                }
            })
            elem.classList.add('select_item_active');
        })
    })
}