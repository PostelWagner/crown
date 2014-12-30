<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductAttribute;
use app\models\ProductAttributeSearch;
use app\models\ProductAttrValue;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductAttributeController implements the CRUD actions for ProductAttribute model.
 */
class ProductAttributeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductAttribute models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductAttributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductAttribute model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductAttribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductAttribute();
        
        $ajaxRequest = (Yii::$app->request->post('datatype')=='ajax');
        $product_id = '';
        
        $error = false;
        
        // если запрос по аяксу, смотрим выбраны ли категории
        if ($ajaxRequest) {
            $catCheck = Yii::$app->request->post('attrInCat');
            if ($catCheck=='1'){

                $product_id         = Yii::$app->request->post('product_id');
                $product            = Product::findOne(['id'=>$product_id]); 
                if ($product !== null) {
                    $model->category = '{'.$product->category_id.'}';                    
                }
                else $error = true;
            }
        }        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {   
            
                // если запрос аяксом делаем запись в таблице значений параметров
                if ($ajaxRequest) {
                    $productAttrValue   = new ProductAttrValue();           

                    $data = [$productAttrValue->formName()=>[
                        'attr_id'   =>  $model->id,
                        'product_id'=>  $product_id
                    ]];
                    if (!$productAttrValue->load($data) || !$productAttrValue->save()){
                        $error = true;
                    }
                }             
            
            $out =  ($ajaxRequest)?  json_encode(['type'=>'OK', 'id'=>$model->id, 'name'=>$model->name, 'html'=>$this->renderAjax('attrTableRow', ['productAttrValue' => $productAttrValue])]):
                    $this->redirect(['view', 'id' => $model->id]);
        } else {
            return  ($ajaxRequest)? json_encode(['type'=>'DATA',  'html'=>$this->renderAjax('create', ['model' => $model, 'for_ajax'=>true])]):
                                    $this->render('create', ['model' => $model]);
        }
        
  
        
        if ($error){
            $out = json_encode(['type'=>'ERROR']);
        }        
        
        return $out;        

    }

    /**
     * Updates an existing ProductAttribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductAttribute model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductAttribute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductAttribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductAttribute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
