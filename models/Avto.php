<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avto".
 *
 * @property integer $id
 * @property string $brand
 * @property string $model
 * @property string $years
 *
 * @property ProductAvto[] $productAvtos
 */
class Avto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand', 'model', 'years'], 'required'],
            [['brand', 'model', 'years'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'years' => 'Years',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAvtos()
    {
        return $this->hasMany(ProductAvto::className(), ['avto_id' => 'id']);
    }
}
