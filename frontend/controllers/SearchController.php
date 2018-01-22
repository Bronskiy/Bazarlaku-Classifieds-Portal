<?php

namespace frontend\controllers;

use common\models\search\ClassifiedSearch;

use yii\web\Controller;


/**
 * ClassifiedController implements the CRUD actions for Classified model.
 */
class SearchController extends Controller
{


    public function actionIndex()
    {
        $this->view->params['sectionClass'] = 'category-page';


        $classifiedModel = new ClassifiedSearch();
        $classifiedProvider = $classifiedModel->search(\Yii::$app->request->queryParams);


        return $this->render('index', [
            'classifiedModel' => $classifiedModel,
            'classifiedProvider' => $classifiedProvider,


        ]);
    }


}
