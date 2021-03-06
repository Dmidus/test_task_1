<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Test task(1)';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <div class="body-content">
        <h4>На YII2 реализовать форму для отправки множественного поля файлов:</h4>
        <p>-До 5 файлов с одной отправки формы</p>
        <p>-Название каждого файла должно транслитилироваться на английский язык и приводиться к нижнему регистру</p>
        <p>-Все файлы должны отправляться в одну директорию с уникальным именем</p>
        <p>-Записывать в БД инфу о загруженных файлах: Имя файла вместе с датой/временем загрузки</p>
        <h4>Сделать страницу на которой будет выведено общим списком информация по загруженным файлам (имя файла и дату/время загрузки)</p>
        <h4>Будет бонусом возможность сортировки по дате</h4>
        <h4>Можно использовать расширения datetimepicker и GridView</h4>       
    </div>
</div>
