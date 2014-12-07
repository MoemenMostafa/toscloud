<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title  */

$this->title =  $title;
$this->params['breadcrumbs'][] = $this->title;
$userId = '';
$error = "Play Fair ;) You have Voted already";
if (!Yii::$app->user->isGuest){
   $userId = Yii::$app->user->identity->id;
}else{
    $error = "Please Login to Be able to rate";
}

?>
<div class="part-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Part', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <div class="col-lg-8">
    
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}',
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                echo Html::beginTag('div', ['class'=>'tos-paragraph '.$model->getStatus($model->id),'id' => 'part-'.$model->id]);
                    echo Html::encode($model->content);
                    echo Html::beginTag('div', ['class'=>'tos-paragraph-actions','id' => $model->id]);
                    echo "<div class='thumbUp' part_id='$model->id'></div>
                          <div id='upScore-$model->id' style='float:left;margin-right:4px'>".$model->getScore($model->id,1)."</div>
                          <div class='thumbDown' part_id='$model->id'></div>
                          <div id='downScore-$model->id' style='float:left;margin-right:4px'>".$model->getScore($model->id,0)."</div>
                          ";
                    echo Html::endTag('div');
                echo Html::endTag('div');
            },
        ]) ?>
    </div>
    <div class="col-lg-4">
    
    </div>
</div>

<?php 
use yii\web\View;
$this->registerJs("
    $('.thumbUp').click(function(){
        var partId = $(this).attr('part_id');
        $.get( 'score/add-score?part_id='+partId+'&value=1&user_id=".$userId."', function( data ) {
          
            $.get( 'score/get-score?id='+partId+'&value=1', function( data ) {
                 $('#upScore-'+partId).html(data.totalItems);
              
            });
            $.get( 'score/get-status?id='+partId, function( data ) {
                 if (data) {
                 $('#part-'+partId).addClass(data);}else{
                    $('#part-'+partId).removeClass('green');
                    $('#part-'+partId).removeClass('red');
                 }
            });
          
          
        }).fail(function(e) {
            alert( '".$error."' );
          });
        
    });
    $('.thumbDown').click(function(){
        var partId = $(this).attr('part_id');
        $.get( 'score/add-score?part_id='+partId+'&value=0&user_id=".$userId."', function( data ) {
            $.get( 'score/get-score?id='+partId+'&value=0', function( data ) {
                 $('#downScore-'+partId).html(data.totalItems);
              
            });
            $.get( 'score/get-status?id='+partId, function( data ) {
                 if (data) {
                 $('#part-'+partId).addClass(data);}else{
                    $('#part-'+partId).removeClass('green');
                    $('#part-'+partId).removeClass('red');
                 }
                 
            });
        }).fail(function(e) {
            alert( '".$error."' );
          });
        
    });
    ");
?>
