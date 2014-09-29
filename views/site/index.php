<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<div class="container-fluid">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'xml')->textarea(['class' => 'form-control', 'style' => 'width: 100%; height: 200px;']) ?>
        <?= $form->field($model, 'xsd')->dropDownList($pasta, ['class' => 'form-control']) ?>
        <?= Html::submitButton('Validar', ['class' => 'btn btn-primary', 'name' => 'button']) ?>
    <?php ActiveForm::end(); ?>
</div>

<?php if(isset($model->xsd) && isset($validate)) : ?>
    <div class="container-fluid" style="margin-top: 50px;">
        <?php if($validate === true) : ?>
            <div class="alert alert-success">
                XML validado com sucesso.
            </div>
        <?php else : ?>
            <?php for($i = 1; $i<=sizeof($validate); $i++) : ?>
                <div class="alert alert-danger">
                    <strong>Erro <?=$i ?>/<?=sizeof($validate)?></strong> - <?php print_r($validate[$i-1]->message); ?>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
<?php endif;?>