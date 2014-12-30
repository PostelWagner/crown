<?php

namespace app\models;



/**
 * This is the model class for table "product_attr".
 *
 * @property integer $id
 * @property string $name
 * @property string $measure
 * @property string $category
 * @property integer $ordering
 *
 * @property ProductAttrValue[] $productAttrValues
 */
class ProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ordering'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['measure', 'category'], 'string', 'max' => 100]
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
            'measure' => 'Measure',
            'category' => 'Category',
            'ordering' => 'Ordering',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrValues()
    {
        return $this->hasMany(ProductAttrValue::className(), ['attr_id' => 'id']);
    }
    
    public function getValuesForProduct($product_id)
    {
        return ProductAttrValue::find()->where(['product_id'=>$product_id, 'attr_id'=>$this->id])->all();
    }    
    
    public static function getAllAttributes()
    {
        return self::find()->asArray()->all();
    }
}
