<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Управленец</title>
</head>

<body>
    </div>
    <?php
        include '/OpenServer/domains/manager/php/conect_db.php';
        $get_name = $_GET['name'];
        $id_plot = '';
        $sql_gardeneer_FIO = '';
        $sql_plot_number = '';
        $sql_conect_fio_number = '
            SELECT plot_information.plot_number, gardener_cards.FIO_gardener,gardener_cards.id_plot
            FROM gardener_cards
            INNER JOIN plot_information ON gardener_cards.id_plot = plot_information.id_plot 
            WHERE gardener_cards.FIO_gardener = "'.$get_name.'"
        ';
        $result_fio_number = mysqli_query($link,$sql_conect_fio_number) or die(mysqli_error($link));
        for($db_arr_FIO_number=[];$row=mysqli_fetch_assoc($result_fio_number); $db_arr_FIO_number[]=$row);
        $sql_plot_number = $db_arr_FIO_number[0]['plot_number'];
        $sql_gardeneer_FIO = $db_arr_FIO_number[0]['FIO_gardener'];
        $id_plot = $db_arr_FIO_number[0]['id_plot'];
        function input_gardeneer_information ($value){
            return '<input style="padding: 0px 0px 0px 10px;" class="maim_info_plot" value="'.$value.'">';
        }
    ?>
    <header>
        <menu>
            <ul class="menu font__14">
               <!-- <li class="font__14 user_select">Начальная страница</li>-->
                <li class="font__14 user_select"><a href="index.php">Карточки садовода</a></li>
                <li class="font__14 user_select"><a href="/php/counters/counters.php">Счетчики</a></li>
                <!--<li class="font__14 user_select">Документы</li>-->
            </ul>
        </menu>
    </header>
    <main>
        <div class="main_panel">
            <div class="main_panel_left">
                <div class="favorites margin-right_20px">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </div>
                <div class="fio_type margin-right_45px">
                    <span class="fio font__25"><?php echo $sql_gardeneer_FIO ?></span>
                    <span class="type_tub font__25">(Карточка садовода)</span>
                </div>
            </div>
            <div class="close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </div>
        <form action="" method="POST">
                <div class="main_panel_left main_panel_button">
                    <div class="main_action active font__14">Записать и закрыть</div>
                    <div class="main_action font__14">Записать</div>
                    <div class="main_action clip font__14"><i class="fa fa-paperclip"
                            aria-hidden="true"></i></div>
                    <div class="main_action font__14">Расчитать</div>
                    <div class="main_action font__14"><i class="fa fa-print" aria-hidden="true"></i><span
                            class="font__14 user_select">Печать</span><i class="fa fa-arrow-down"
                            aria-hidden="true"></i>
                    </div>
                    <div class="main_action font__14"><i class="fa fa-file-text-o" aria-hidden="true"></i><span
                            class="font__14">Отчеты</span><i class="fa fa-arrow-down"
                            aria-hidden="true"></i>
                    </div>
                </div>
        </form>
        <div class="main_info">
            <div class="main_info_item"><span
                    class="font__14 user_select">Участок:</span><?php echo input_gardeneer_information($sql_plot_number)?>
            </div>
            <div class="main_info_item"><span
                    class="font__14 user_select">Владелец:</span><?php echo input_gardeneer_information($sql_gardeneer_FIO)?>
            </div>
        </div>
        <div class="intelligence">
            <?php
                echo '
                    <a href="/php/gardeneers/gardeneer_card/card_page.php?name='.$get_name.'&number=0" class="intelligence_item font__14 user_select">Общие сведения</a>
                    <a href="/php/gardeneers/gardeneer_card/card_page.php?name='.$get_name.'&number=1" class="intelligence_item font__14 user_select">Начисления</a>
                    <a href="/php/gardeneers/gardeneer_card/card_page.php?name='.$get_name.'&number=2" class="intelligence_item font__14 user_select">Счетчики</a>
                    <a href="/php/gardeneers/gardeneer_card/card_page.php?name='.$get_name.'&number=3" class="intelligence_item font__14 user_select">Расчеты</a>   
                '
            ?>
        </div>
        <div class="form_gardeneer_catd">
            <?php include '/OpenServer/domains/manager/php/gardeneers/gardeneer_card/gardeneer_tabs_render.php'; ?>
        </div>
        <div class="main_commetn">
            <div class="main_commetn_item"><span class="font__14 user_select">Комментарии:</span><input></div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="https://use.fontawesome.com/17d2f0baf1.js"></script>
    <script src="/js/calculate_width_table.js"></script>
    <script src="/js/gardeneers/gardeneer/gardeneer_tabs.js"></script>
</body>

</html>