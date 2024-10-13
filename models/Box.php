<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "boxes".
 *
 * @property int $id
 * @property float $width
 * @property float $height
 * @property float $length
 * @property float $weight
 * @property string $reference
 * @property string $status
 * @property string $created_at
 *
 * @property BoxCard[] $boxCards
 */
class Box extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['width', 'height', 'length', 'weight', 'reference'], 'required'],
            [['width', 'height', 'length', 'weight'], 'number'],
            [['created_at'], 'safe'],
            [['reference', 'status'], 'string', 'max' => 255],
            ['volume', 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'width' => 'Width',
            'height' => 'Height',
            'length' => 'Length',
            'weight' => 'Weight',
            'reference' => 'Reference',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[BoxCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoxCards()
    {
        return $this->hasMany(BoxCard::class, ['box_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || ($this->isModified() && $this->status !== 'Prepared')) {
                $this->volume = $this->calculateVolume();
            }
            return true;
        }
        return false;
    }

    public function calculateVolume()
    {
        return $this->width * $this->length * $this->height;
    }

    public function calculateTotalValue()
    {
        $totalValue = 0;

        foreach ($this->getBoxCards()->all() as $boxCard) {
            $totalValue += $boxCard->price * $boxCard->shipped_qty;
        }

        return $totalValue;
    }

    public function checkQuantities()
    {
        $hasMismatch = false;

        foreach ($this->getBoxCards()->all() as $boxCard) {
            if ($boxCard->shipped_qty != $boxCard->received_qty) {
                $hasMismatch = true;
                break;
            }
        }
        $this->has_mismatched_quantities = $hasMismatch;
        $this->save(false);
    }
    public function getVolume()
    {
        return $this->length * $this->width * $this->height; // Assuming length, width, and height are properties of the Box model.
    }

}
