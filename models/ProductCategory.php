<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $parent_id
 * @property integer $status
 * @property integer $ordering
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product[] $products
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    
    const PUBLISHED = 1;
    const UNPUBLISHED = 0;    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
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
            [['name'], 'required'],
            [['description'], 'string'],
            [['parent_id', 'status', 'ordering'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255]
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
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'ordering' => 'Ordering',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
    
    public static function getCategories($status=[self::PUBLISHED])
    {
        return  self::find()
            ->where(['status'=>$status])    
            ->orderBy(['id'=>SORT_DESC])
            ->asArray()->all();                
    }
    
    public static function getLastCategoryId()
    {
         return  self::find()->max('id');           
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
