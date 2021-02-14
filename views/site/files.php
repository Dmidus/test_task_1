<?php

    use yii\grid\GridView;
    use yii\helpers\Html;

    $this->title = 'Список файлов';
?>
    <div class="jumbotron">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
<?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
    ]);
