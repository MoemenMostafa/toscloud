<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Text;

class CreateController extends \yii\web\Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
    	$model = new Text();
    	if($model->load(Yii::$app->request->post()))
        {
            print_r(Yii::$app->request->post());
            #$model->save();
            
            #$this->redirect(['/']);
        }
        return $this->render('index', [
                'model' => $model,
            ]);
    }
    

}
