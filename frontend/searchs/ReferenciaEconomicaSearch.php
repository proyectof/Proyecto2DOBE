<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReferenciaEconomica;

/**
 * ReferenciaEconomicaSearch represents the model behind the search form about `frontend\models\ReferenciaEconomica`.
 */
class ReferenciaEconomicaSearch extends ReferenciaEconomica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_referencia_economica', 'trabaja', 'edad', 'id_referencia_familiar', 'id_ficha'], 'integer'],
            [['grado_estudio', 'ocupacion', 'direccion_trabajo', 'estado_civil'], 'safe'],
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
        $query = ReferenciaEconomica::find()->where(['id_ficha' => $idFicha]);

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
            'id_referencia_economica' => $this->id_referencia_economica,
            'trabaja' => $this->trabaja,
            'edad' => $this->edad,
            'id_referencia_familiar' => $this->id_referencia_familiar,
            'id_ficha' => $this->id_ficha,
        ]);

        $query->andFilterWhere(['like', 'grado_estudio', $this->grado_estudio])
            ->andFilterWhere(['like', 'ocupacion', $this->ocupacion])
            ->andFilterWhere(['like', 'direccion_trabajo', $this->direccion_trabajo])
            ->andFilterWhere(['like', 'estado_civil', $this->estado_civil]);

        return $dataProvider;
    }
}
