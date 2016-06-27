<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Galeria;

/**
 * GaleriaSearch represents the model behind the search form about `frontend\models\Galeria`.
 */
class GaleriaSearch extends Galeria
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_foto'], 'integer'],
            [['extension', 'fecha', 'hora'], 'safe'],
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
        $query = Galeria::find();

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
            'id_foto' => $this->id_foto,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        $query->andFilterWhere(['like', 'extension', $this->extension]);

        return $dataProvider;
    }
}
