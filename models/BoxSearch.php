<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class BoxSearch extends Box
    {
        public $dateFrom;
        public $dateTo;
        public $searchTerm;

        public function rules()
    {
            return [
                [['dateFrom', 'dateTo'], 'safe'],
                [['searchTerm'], 'string'],
                [['status'], 'in', 'range' => ['Expected', 'At warehouse', '']],
                ];
    }

        public function search($params)
                {
                     $query = Box::find();

                     $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

                $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

        if ($this->dateFrom) {
                $query->andFilterWhere(['>=', 'created_at', $this->dateFrom]);
        }
        if ($this->dateTo) {
                $query->andFilterWhere(['<=', 'created_at', $this->dateTo]);
        }


             if ($this->searchTerm) {
        $query->andFilterWhere(['or',
        ['id' => $this->searchTerm],
        ['like', 'reference', $this->searchTerm],
    ]);
        }


        $query->andFilterWhere(['status' => $this->status]);

            return $dataProvider;
        }
    }
