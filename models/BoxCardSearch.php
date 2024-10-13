<?php

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;


class BoxCardSearch extends BoxCard
{
    public function rules()
    {
        return [
            [['id', 'box_id'], 'integer'],
            [['reference', 'weight', 'width', 'length', 'height', 'status'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = BoxCard::find();


        $this->load($params);


        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['shipped_qty' => $this->shipped_qty])
            ->andFilterWhere(['received_qty' => $this->received_qty])
            ->andFilterWhere(['price' => $this->price]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
