<?php

namespace common\components;

use Yii;
use yii\base\Component;

class Checked extends Component {
    
    public function checkStatus($status){
        if($status == 1){
            return "Active";
        }else{
            return "Not Active";
        }
    }
    
    public function checkType($type){
        if($type == 1){
            return "Free Post";
        }else{
            return "Login Required";
        }
    }
}

