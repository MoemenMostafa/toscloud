<?php

namespace app\controllers;
use yii\db\Query;
use app\models\Score;
use app\models\Comment;

class ScoreController extends \yii\web\Controller
{
    public function actionAddScore()
    {
         $params=$_REQUEST;
        
            $userId = $params['user_id']; 
            $part_id = $params['part_id'];
        
        $voted = \app\models\Score::find()->select(['*'])
                                        ->where("user_id = $userId AND part_id=$part_id")
                                        ->count();

        if (!$voted){
          $model = new Score();
          $model->attributes=$params;
          
          if ($model->save()) {
              $this->setHeader(200);
              echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
          } 
          else
          {
          $this->setHeader(400);
          echo json_encode(array('status'=>0,'error_code'=>400,'errors'=>$model->errors),JSON_PRETTY_PRINT);
          }
        }else{
            $this->setHeader(200);
            echo json_encode(array('status'=>0,'error_code'=>200,'errors'=>$model->errors),JSON_PRETTY_PRINT);
 
        }
    }

    public function actionGetScore()
    {
          $params=$_REQUEST;
          $id="";
          $value="";
 
           if(isset($params['id']))
             $id=$params['id'];
             $value=$params['value'];
             
           $query=new Query();
           $query->from('score')
             ->andFilterWhere(['=', 'part_id', $id])
             ->andFilterWhere(['=', 'value', $value])
             ->select("id");
 
   
            $command = $query->createCommand();
            $models = $command->queryAll();
            
            $totalItems=$query->count();
 
          $this->setHeader(200);
 
          echo json_encode(array('status'=>1,/*'data'=>$models,*/'totalItems'=>$totalItems),JSON_PRETTY_PRINT);
 
    }
    
    public function actionGetStatus()
    {
          $params=$_REQUEST;
          $id=$params['id'];
 
 
         $up = \app\models\Score::find()->select(['*'])
                                        ->where("value =1 AND part_id=$id")
                                        ->count();
        $down = \app\models\Score::find()->select(['*'])
                                        ->where("value =0 AND part_id=$id")
                                        ->count();
        $result = $up - $down;
        
        if ($result > 0){
            echo "green";
        }
        if ($result < 0){
            echo "red";
        }
 
 
    }
    
    public function actionGetComments()
    {
          $params=$_REQUEST;
          $id=$params['id'];
 
 
         $count = \app\models\Comment::find()->select(['*'])
                                        ->where("part_id=$id")
                                        ->count();
        $comments = \app\models\Comment::find()->select(['comment.id','user.username','comment.content'])
                                    ->join('LEFT JOIN',
                                            'user',
                                            'user.id =comment.user_id'
                                            )
                                    ->where("comment.part_id=$id")
                                    ->asArray()
                                    ->all();
        
        if($count){
            $this->setHeader(200);
            echo json_encode($comments);
        }else{
            $this->setHeader(200);
            echo json_encode(array('status'=>0));
        }
 
    }
    
    
    public function actionAddComment()
    {
         $params=$_REQUEST;
        
            $userId = $params['user_id']; 
            $part_id = $params['part_id'];
            $content = $params['content'];

          $model = new Comment();
          $model->attributes=$params;
          
          if ($model->save()) {
              $this->setHeader(200);
              echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
          } 
          else
          {
              $this->setHeader(400);
              echo json_encode(array('status'=>0,'error_code'=>400,'errors'=>$model->errors),JSON_PRETTY_PRINT);
          }
    }
    

    public function actionIndex()
    {
        echo "Test";
    }

    /* Functions to set header with status code. eg: 200 OK ,400 Bad Request etc..*/      
    private function setHeader($status)
    {
     
          $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
          $content_type="application/json; charset=utf-8";
     
          header($status_header);
          header('Content-type: ' . $content_type);
          header('X-Powered-By: ' . "Nintriva <nintriva.com>");
    }
    
    private function _getStatusCodeMessage($status)
    {
          $codes = Array(
          200 => 'OK',
          400 => 'Bad Request',
          401 => 'Unauthorized',
          402 => 'Payment Required',
          403 => 'Forbidden',
          404 => 'Not Found',
          500 => 'Internal Server Error',
          501 => 'Not Implemented',
          );
          return (isset($codes[$status])) ? $codes[$status] : '';
    }
}
