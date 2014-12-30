<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use app\models\ProductAttribute;
use app\models\ProductAttrValue;
use app\models\ProductImages;
use app\models\ProductCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use DamerauLevenshtein\DamerauLevenshtein;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    protected $_imagePath = '@webroot/product_images';
    
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $productModel = new Product();
        
        
        //$dl = new DamerauLevenshtein('мама мыла раму', 'папа мыл раму');
        
        //return $dl->getRelativeDistance();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'productModel' => $productModel,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
 
    public function actionCreate()
    {
        $productModel = new Product();
        
        $ajaxRequest = (Yii::$app->request->post('datatype')=='ajax');
                
        // временно ставим последнюю категорию новому товару
        $tempCategory = ProductCategory::getLastCategoryId();
        
        $productModel->category_id = $tempCategory;
        
        if ($productModel->load(Yii::$app->request->post()) && $productModel->save()) {
            // создаем папку для картинок
            $folder_name = Yii::getAlias($this->_imagePath.'/'.'product'.$productModel->id);
            $thumb_folder_name = Yii::getAlias($this->_imagePath.'/'.'product'.$productModel->id.'_thumb');
            if(!is_dir($folder_name))
                mkdir($folder_name, 0777, true);  
            if(!is_dir($thumb_folder_name))
                mkdir($thumb_folder_name, 0777, true);  
            
            return json_encode(['type'=>'OK']);
        } else {
            return json_encode(['type'=>'DATA', 'html'=>$this->renderAjax('_mini_product_create', ['productModel' => $productModel]) ]);
        }       
        
    }    

    /**
     * Updates an existing Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        
        $productModel =  $this->findModel($id);
        
        $productAttrValueModel = new ProductAttrValue(); 
        
        $productAttributeModel = new ProductAttribute();
        
        $productAttrValues  = Yii::$app->request->post($productAttrValueModel->formName(), []);
        
        $productNewAttr     = Yii::$app->request->post('ProductNewAttr', []);
        
        $productImages      = new ProductImages();
        
        $error = false;

        // сохраняем продукт
        if ($productModel->load(Yii::$app->request->post()) && $productModel->save()) {
            
            // сохраняем атрибуты
            foreach ($productAttrValues as $attr_id=>$attrValue){
                $productAttrValueModel = ProductAttrValue::findOne($attr_id);
                
                $data = [$productAttrValueModel->formName()=>$attrValue];
                if (!$productAttrValueModel->load($data) || !$productAttrValueModel->save()){
                        $error = true;                   
                }   
            }
            

            foreach ($productNewAttr as $attr_id=>$attrValue){
                if (empty($attrValue))                    continue;
                $productAttrValueModel = new ProductAttrValue();
                
                $data = [$productAttrValueModel->formName()=>['attr_id'=>$attr_id, 'product_id'=>$id, 'value'=>$attrValue]];
                if (!$productAttrValueModel->load($data) || !$productAttrValueModel->save()){
                        $error = true;                   
                }                 
            }

        } else {
            $error = true;           
        }
        
        if ($error){
            return $this->render('update', [
                'productModel' => $productModel,
                'productAttributeModel' => $productAttributeModel,
                'productImages' => $productImages
            ]);
        } else {
            return $this->actionIndex();           
        }
    }
    
    public function actionProductImgAdd()
    {
        $ajaxRequest = (Yii::$app->request->post('datatype')=='ajax');

        if (!$ajaxRequest) {
            return $this->goHome();
        }
        
        $productImages = new ProductImages();
        
        $path    =   Yii::$app->request->post('path');
        $product_id =   Yii::$app->request->post('product_id');
        $formName   = $productImages->formName();

        if ($productImages->load([$formName=>['path'=>$path, 'product_id'=>$product_id]]) && $productImages->save()) {
            return json_encode(['type'=>'OK', 'html'=>$this->renderAjax('_img_table_row', ['productImages' => $productImages, 'product_id'=>$product_id]) ]);
        } else {
            return json_encode(['type'=>'SOMETHING WRONG']);
        }                    
        
    }
    
    public function actionProductAttrAdd()
    {
        $ajaxRequest = (Yii::$app->request->post('datatype')=='ajax');

        if (!$ajaxRequest) {
            return $this->goHome();
        }
        
        $productAttrValue = new ProductAttrValue();
        
        $attr_id    =   Yii::$app->request->post('attr_id');
        $product_id =   Yii::$app->request->post('product_id');
        $formName   = $productAttrValue->formName();

        
        if ($productAttrValue->load([$formName=>['attr_id'=>$attr_id, 'product_id'=>$product_id]]) && $productAttrValue->save()) {
            return json_encode(['type'=>'OK', 'html'=>$this->renderAjax('attrTableRow', ['productAttrValue' => $productAttrValue]) ]);
        } else {
            return json_encode(['type'=>'SOMETHING WRONG']);
        }                    
        
    }    
    
    public function actionProductAttrDelete()
    {
        $ajaxRequest = (Yii::$app->request->post('datatype')=='ajax');
        
        if (!$ajaxRequest) {
            return $this->goHome();
        }
        
        $prod_attr_id    =   Yii::$app->request->post('prod_attr_id');
        
        $model = ProductAttrValue::findOne($prod_attr_id);
        
        $id = $model->id;
        if ($model !== null && $model->delete()==1){
           return json_encode(['type'=>'OK', 'id'=>$id]); 
        }
        else {
            return json_encode(['type'=>'SOMETHING WRONG']);
        }
        
        
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
