<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Citacion;

/**
 * CitacionSearch represents the model behind the search form about `frontend\models\Citacion`.
 */
class CitacionSearch extends Citacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_citacion', 'id_ficha'], 'integer'],
            [['fecha', 'curso', 'causa','paralelo'], 'safe'],
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
    public function search($params,$idFicha)
    {
        $query = Citacion::find()->where(['id_ficha' => $idFicha]);

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
            'id_citacion' => $this->id_citacion,
            'id_ficha' => $this->id_ficha,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'curso', $this->curso])
            ->andFilterWhere(['like', 'paralelo', $this->paralelo])
            ->andFilterWhere(['like', 'causa', $this->causa])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
