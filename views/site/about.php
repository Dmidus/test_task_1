<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О проекте';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="jumbotron">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <div class="body-content">
        <h4>Версии используемых инструментов:</h4>
        <p>-OC Windows 10 64 bit</p>
        <p>-Yii 2.0.40</p>
        <p>-PHP 7.2.34</p>
        <p>-XAMPP 7.2.34</p>
        <h4>Предварительные настройки</h4>
        <p>-Создать на mysql базу данных с именем test_task_1</p>
        <p>-Выполнить в этой базе данных скрипт из папки sql в корне проекта</p>
        <p>-Создать в папке web папку uploads</p>
        <h4>Замечания к проекту</h4>
        <p>-При разработке проекта использовал XAMPP</p>
        <p>-Yii2 установил при помощи Composer (create project), предварительно установив Composer</p>
        <p>-Похоже это не самые лучшие инструменты. Хелпер Inflector (Ни Inflector::slug ни Inflector::transliterate) не сработали и пришлось написать жуткий костыль</p>
    </div>

</div>
