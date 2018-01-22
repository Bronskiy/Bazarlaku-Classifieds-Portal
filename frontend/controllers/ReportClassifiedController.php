<?php

namespace frontend\controllers;

use Yii;

class ReportClassifiedController extends \yii\web\Controller
{
    public function actionReport() {
       $modelReport = new \common\models\ReportClassified();

       if ($modelReport->load(Yii::$app->request->post())) {
           
           $modelReport->create_at = new \yii\db\Expression('NOW()');
           $modelReport->update_at = new \yii\db\Expression('NOW()');
           $modelReport->checked = 0;
           
           if($modelReport->save()){
              Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Thanks you for your report. We will check this ad.'));
              return $this->redirect(Yii::$app->request->referrer);
           }
        } else {
           echo 'failed to report classified';
        }
    }

}
