<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\includes\CommonUtility;
use yii\web\View;
use components\widgets\KindEditor;


$formatArray=CommonUtility::getTitleFormat();
$formatValueArray = CommonUtility::getTitleFormatArray($model);

?>

<div class="page-form">

    <?php
    	$disabled= $model->isNewRecord? null:'disabled';
    	$form = ActiveForm::begin([
			'fieldConfig' => $this->getDefaultFieldConfig2(),
			'options'=>[
				'enctype'=>'multipart/form-data',
			],
	    ]); ?>

    	<table class="table">

    	<?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

      <tr class="form-group field-page-title_format">
		<td class="hAlign_right padding_r10">
			<label style="font-weight:normal;" for="page-title_format">标题格式</label>:</td>
		<td>
			<?php 
				foreach ($formatArray as $value=>$label)
				{
					$checked='';
					foreach ($formatValueArray as $index=>$tempValue)
					{
						if($value==$tempValue)
						{
							$checked=' checked';
							unset($formatValueArray[$index]);
							break;
						}
					}
			?>
				<label class="checkbox-inline"><input type="checkbox" name="Page[title_format][]" id="page-title_format_<?= $value ?>" 
						value="<?= $value ?>" <?php echo $checked?>><?= $label ?></label>
			<?php }?>
			
			<input name="Page[title_format][]" id="page-title_format_c" class="form-control" 
				style="display: inline-block;width:80px; margin-left:10px;" value="<?php echo end($formatValueArray);?>"/>
			<label style="font-weight:normal;" for="page-title_format_c" >颜色</label>
		</td>
		<td><div class="help-block"></div></td>
	</tr>
    
    <tr class="form-group field-page-title_pic">
		<td class="hAlign_right padding_r10" ><label style="font-weight:normal;" for="page-title_pic">标题图片</label>:</td>
		<td>
			<div class="file-box">
			<input type="text" id="page-title_pic" class="form-control" style="display: inline-block; width:500px; " 
				name="Page[title_pic]" value="<?php echo $model['title_pic']?>" maxlength="128">
			<input type='button' class='form-control' style="display: inline-block;width:60px;" value='浏览...' /> 
			<input type="file" name="Page[title_pic]" class="form-control file" 
				onchange="document.getElementById('page-title_pic').value=getPath(this);" /> 
			</div>
		</td>
		<td><div class="help-block"></div></td>
	</tr>
    
    <?= $form->field($model, 'summary')->textarea(['rows' => 5]) ?>
    
    <?= $form->field($model, 'body')->textarea(['rows' => 25]) ?>
    <?php KindEditor::widget(['id'=>'page-body'])?>
    
    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'seo_description')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'tpl')->dropDownList($tpls) ?>
    
    <?= $form->field($model, 'category_id')->dropDownList($categories) ?>
    
    <?= $form->field($model, 'sort_num')->textInput() ?>
    
    <?= $form->field($model, 'publish_time')->textInput() ?>
    
    <?= $form->field($model, 'modify_time')->textInput() ?>
    
    <?= $form->field($model, 'status')->dropDownList(CommonUtility::getStatus()) ?>
    
    <?php $this->echoButtons($model); ?>
	</table>
	
    <?php ActiveForm::end(); ?>

</div>
