<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Отправка файлов';
?>

<div class="jumbotron">
    <h2><?= Html::encode($this->title) ?></h2>
</div>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'uploadedFiles[]')->fileInput(['multiple' => true, 'accept' => '*/*', 'caption' => 'Загрузка файлов'])->label('Загрузка от 1 до 5 файлов') ?>

    <button>Отправить файлы</button>

<?php ActiveForm::end() ?>