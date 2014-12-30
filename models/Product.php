<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $category_id
 * @property integer $status
 * @property integer $ordering
 * @property double $cost
 * @property string $ean
 * @property string $preview_img_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProductCategory $category
 * @property ProductAttrValue[] $productAttrValues
 * @property ProductAvto[] $productAvtos
 * @property ProductImages[] $productImages
 * @property ProductRelated[] $productRelateds
 */
class Product extends \yii\db\ActiveRecord
{

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */    
    public function behaviors()
    {
        return [
           'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }    
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['description'], 'string'],
            [['category_id', 'status', 'preview_img_id', 'ordering'], 'integer'],
            [['cost'], 'number'],
            ['cost', 'default', 'value' => 0],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['ean'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'ordering' => 'Ordering',
            'cost' => 'Cost',
            'ean' => 'Ean',
            'preview_img_id' => 'Preview image ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreviewImg()
    {
        return $this->hasOne(ProductImages::className(), ['id' => 'preview_img_id']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrValues()
    {
        return $this->hasMany(ProductAttrValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAvtos()
    {
        return $this->hasMany(ProductAvto::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRelateds()
    {
        return $this->hasMany(ProductRelated::className(), ['product_related' => 'id']);
    }
    
    public function getProductAttributes()
    {
        $attributesList = new ActiveDataProvider([
                            'query' => ProductAttribute::find()
                                        ->joinWith('productAttrValues', true, 'LEFT JOIN')
                                        ->where('product_id=:product_id', [':product_id'=>$this->id])
                                        ->orWhere('category like :category_id', [':category_id'=>'%{'.$this->category_id.'}%']),                       
        ]);        
        $data = $attributesList->getModels();
        
        return $data;
    }     
    
    public static function getStatus()
    {
        return [
                ['id'=>self::PUBLISHED,
                 'name'=>'Опубликовано'],
                ['id'=>self::UNPUBLISHED,
                 'name'=>'Не опубликовано'],
                ];
    }
}
