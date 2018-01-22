<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;

class DependentController extends Controller {
    
    /* Mendapatkan nilai Region berdasarkan Country */
    public function actionGetregion($id){
        $rows = \common\models\Region::find()->where(['country_id' => $id, 'is_status' => 1])->all();
        echo "<option value=''>".Yii::t('frontend', '-- Select Region --')."</option>";
        
        if(count($rows)>0){
            foreach ($rows as $row){
                echo "<option value='$row->id'>$row->region</option>";
            }
        }else{
            echo "";
        }
    }
    
    /* Mendapat nilai city berdasarkan Region */
    public function actionGetcity($id){
        $rows = \common\models\City::find()->where(['region_id' => $id, 'is_status' => 1])->all();
        echo "<option value=''>".Yii::t('frontend', '-- Select City --')."</option>";
        
        if(count($rows) > 0){
            foreach ($rows as $row){
                echo "<option value='$row->id'>$row->city</option>";
            }
        }else{
            echo "";
        }
    }
    
    
     /* Mendapatkan nilai Category berdasarkan Main Category */
    public function actionGetcategory($id){
        $rows = \common\models\Category::find()->where(['main_category_id' => $id, 'is_status' => 1])->all();
        echo "<option value=''>".Yii::t('frontend', '-- Select Category --')."</option>";
        
        if(count($rows)>0){
            foreach ($rows as $row){
                echo "<option value='$row->id'>$row->category</option>";
            }
        }else{
            echo "";
        }
    }
}