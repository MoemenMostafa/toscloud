<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Text;
use app\models\Part;
use app\models\Service;

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
            $text = Yii::$app->request->post('Text');
            $service =  $text['service'];
            $isService = \app\models\Service::find()->select(['*'])
                                        ->where("name = '$service'")
                                        ->count();

                                        
            if ($isService) {
                $result =  \app\models\Service::find()->select(['*'])
                                        ->where("name = '$service'")
                                        ->asArray()
                                        ->all();
                $serviceID =  $result[0]['id'];
                $model->service_id = $serviceID;
            }else{
                $modelService = new Service();
                $modelService->name = $service;
                $modelService->user_id = Yii::$app->user->identity->id;
                if($modelService->save()){
                    $model->service_id = $modelService->id;
                };
            }
            
            $isServiceNType = \app\models\Text::find()->select(['*'])
                                        ->where("service_id = {$model->service_id} AND  type_id = {$text['type_id']}")
                                        ->count();
            if (!$isServiceNType){                     
                $model->user_id =  Yii::$app->user->identity->id;
                if($model->save())
                {
                    // Split text into parts and save to database
                    $parts = preg_split('#(\r\n?|\n)+#', $text['content']);
                    
                    $x=1;
                    $part = null;
                    foreach ($parts as $part){
                        if (trim($part) !== ""){
                            $modelPart = new Part();
                            $modelPart->text_id = $model->id;
                            $modelPart->content = $part;
                            $modelPart->contentOrder = $x;
                            $x++;
                            $modelPart->save();
                        }
                    }
                }
            

                $this->redirect(['/part', 'id' => $model->id]);
            }
        }
        return $this->render('index', [
                'model' => $model,
            ]);
    }
    

}
