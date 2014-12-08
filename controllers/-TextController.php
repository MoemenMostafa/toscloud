<?php

namespace app\controllers;

use app\models\Text;

class CreateController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$model = new Text();
        return $this->render('index', [
                'model' => $model,
            ]);
    }

}
