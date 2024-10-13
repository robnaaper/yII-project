<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "box_card".
 *
 * @property int $id
 * @property string $title
 * @property string $sku
 * @property int $shipped_qty
 * @property int|null $received_qty
 * @property float|null $price
 * @property int $box_id

 * @property Boxes $box
 */
class BoxCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'box_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'sku', 'shipped_qty', 'box_id'], 'required'],
            [['shipped_qty', 'received_qty', 'box_id'], 'integer'],
            [['price'], 'number'],
            [['title', 'sku'], 'string', 'max' => 255],
            [['sku'], 'unique'],
            [['box_id'], 'exist', 'skipOnError' => true, 'targetClass' => Box::class, 'targetAttribute' => ['box_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sku' => 'Sku',
            'shipped_qty' => 'Shipped Qty',
            'received_qty' => 'Received Qty',
            'price' => 'Price',
            'box_id' => 'Box ID',
        ];
    }

    /**
     * Gets query for [[Box]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBox()
    {
        return $this->hasOne(Box::class, ['id' => 'box_id']);
    }
}
