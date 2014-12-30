<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_avto".
 *
 * @property integer $product_id
 * @property integer $avto_id
 *
 * @property Avto $avto
 * @property Product $product
 */
class ProductAvto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_avto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'avto_id'], 'required'],
            [['product_id', 'avto_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'avto_id' => 'Avto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvto()
    {
        return $this->hasOne(Avto::className(), ['id' => 'avto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
