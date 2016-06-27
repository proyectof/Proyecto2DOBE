<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReferenciaFamiliar;

/**
 * ReferenciaFamiliarSearch represents the model behind the search form about `frontend\models\ReferenciaFamiliar`.
 */
class ReferenciaFamiliarSearch extends ReferenciaFamiliar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_referencia_familiar', 'id_ficha'], 'integer'],
            [['parentesco', 'nombres', 'apellidos', 'cedula', 'telefono_celular','telefono_convencional'], 'safe'],
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
        $query = ReferenciaFamiliar::find()->where(['id_ficha' => $idFicha]);

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
            'id_referencia_familiar' => $this->id_referencia_familiar,
            'id_ficha' => $this->id_ficha,
        ]);

        $query->andFilterWhere(['like', 'parentesco', $this->parentesco])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'telefono_celular', $this->telefono_celular])
            ->andFilterWhere(['like', 'telefono_convencional', $this->telefono_convencional]);

        return $dataProvider;
    }
}
