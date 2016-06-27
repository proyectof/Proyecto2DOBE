<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sancion;

/**
 * SancionSearch represents the model behind the search form about `frontend\models\Sancion`.
 */
class SancionSearch extends Sancion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sancion', 'id_ficha'], 'integer'],
            [['fecha', 'causa','fecha_desde', 'fecha_hasta','descripcion','observacion'], 'safe'],
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
        $query = Sancion::find()->where(['id_ficha' => $idFicha]);

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
            'id_sancion' => $this->id_sancion,
            'id_ficha' => $this->id_ficha,
            'fecha' => $this->fecha,
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
        ]);

        $query->andFilterWhere(['like', 'causa', $this->causa])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
