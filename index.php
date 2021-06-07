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
    <?php
      include 'php/conect_db.php';  
    ?>
    <header>
        <menu>
            <ul class="menu font__14">
                <!--<li class="font__14 user_select">Начальная страница</li> -->
                <li class="font__14 user_select"><a href="#">Карточки садовода</a></li>
                <li class="font__14 user_select"><a href="/php/counters/counters.php">Счетчики</a></li>
               <!-- <li class="font__14 user_select">Документы</li> -->
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
                    <span class="fio font__25">Карточки садовода</span>
                </div>
            </div>
            <div class="right">
                <div class="close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="main_table">
            <div class="main_servises">
                <a href="index.php?gardeneers_button_number=0" class="main_servises_itm font__14 user_select main_active">Основное</a>
                <a href="index.php?gardeneers_button_number=1" class="main_servises_itm font__14 user_select">Услуги</a>
                <a href="index.php?gardeneers_button_number=2" class="main_servises_itm font__14 user_select">Начисления</a>
                <a href="index.php?gardeneers_button_number=3" class="main_servises_itm font__14 user_select">Перерасчёт</a>
                <a href="index.php?gardeneers_button_number=4" class="main_servises_itm font__14 user_select">Регламентные операции</a>
                <a href="index.php?gardeneers_button_number=5" class="main_servises_itm font__14 user_select">Рассылка квитанций</a>
                <a href="index.php?gardeneers_button_number=6" class="main_servises_itm font__14 user_select">Печатные формы</a>
            </div>
            <?php include 'php/gardeneers/gardeneers_buttons_render.php';?>
        </div>
        </div>
        </div>
        </div>
    </main>
    </main>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/gardeneers/print_form_tabs.js"></script>
    <script src="https://use.fontawesome.com/17d2f0baf1.js"></script>
    <script src="/js/gardeneers/gardeneers_buttons.js"></script>
</body>

</html>