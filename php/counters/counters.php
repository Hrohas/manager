<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Счетчики</title>
</head>

<body>
    <?php
        include '/OpenServer/domains/manager/php/conect_db.php';   
    ?>
    <header>
        <menu>
            <ul class="menu font__14">
                <!-- <li class="font__14 user_select">Начальная страница</li>-->
                <li class="font__14 user_select"><a href="index.php">Карточки садовода</a></li>
                <li class="font__14 user_select">Счетчики</li>
               <!-- <li class="font__14 user_select">Документы</li> -->
            </ul>
        </menu>
    </header>
    <main>
        <div class="main_panel">
            <div class="left">
                <div class="fio_type margin-right_45px">
                    <span class="fio font__25">Счетчики</span>
                </div>
            </div>
            <div class="right">
                <div class="close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="count_servises">
            <a href="/php/counters/counters.php?count_button_number=0"  class="main_servises_itm font__14 user_select">Основное</a>
            <a href="/php/counters/counters.php?count_button_number=1"  class="main_servises_itm font__14 user_select">Показания счетчиков</a>
            <a href="/php/counters/counters.php?count_button_number=2"  class="main_servises_itm font__14 user_select">Показания групповых счетчиков</a>
            <a href="/php/counters/counters.php?count_button_number=3"  class="main_servises_itm font__14 user_select">Начисления при непредоставлении показаний счетчиков</a>
            <a href="/php/counters/counters.php?count_button_number=4"  class="main_servises_itm font__14 user_select">Изменение состояния счетчиков</a>
        </div>
        <?php
            include '/OpenServer/domains/manager/php/counters/counters_table_render.php';
        ?>
        <script src="https://use.fontawesome.com/17d2f0baf1.js"></script>
        <script src="/js/counters/counters_tabs.js"> </script> 
        
</body>

</html>