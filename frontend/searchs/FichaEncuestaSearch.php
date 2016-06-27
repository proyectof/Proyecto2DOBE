<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FichaEncuesta;

/**
 * FichaEncuestaSearch represents the model behind the search form about `frontend\models\FichaEncuesta`.
 */
class FichaEncuestaSearch extends FichaEncuesta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ficha_encuesta', 'id_encuesta', 'id_ficha'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FichaEncuesta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_ficha_encuesta' => $this->id_ficha_encuesta,
            'id_encuesta' => $this->id_encuesta,
            'id_ficha' => $this->id_ficha,
        ]);

        return $dataProvider;
    }
}
