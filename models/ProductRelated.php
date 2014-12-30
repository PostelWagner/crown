<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_related".
 *
 * @property integer $product_id
 * @property integer $product_related
 *
 * @property Product $product
 * @property Product $productRelated
 */
class ProductRelated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_related';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_related'], 'required'],
            [['product_id', 'product_related'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_related' => 'Product Related',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRelated()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_related']);
    }
}
