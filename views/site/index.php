<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<div class="container-fluid">
    <?php $form = ActiveForm::begin(['id' => 'form', 'options' => ['class' => 'form-horizontal']]); ?>
        <div class="form-group">
            <label class="col-sm-1 control-label">XML</label>
            <div class="col-sm-11">
                <?= Html::activeTextArea($model, 'xml', ['class' => 'form-control', 'style' => 'width: 100%; height: 200px;']) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">XSD</label>
            <div class="col-sm-11">
                <?= Html::activeDropDownList($model, 'xsd', $pasta, ['class' => 'form-control']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-11">
                <?= Html::submitButton('Validar', ['class' => 'btn btn-primary', 'name' => 'button']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<?php if(isset($model->xsd) && isset($validate)) : ?>
    <div class="container-fluid" style="margin-top: 50px;">
        <?php if(is_null($validate)) : ?>
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