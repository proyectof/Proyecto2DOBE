<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AspectoAcademico;

/**
 * AspectoAcademicoSearch represents the model behind the search form about `frontend\models\AspectoAcademico`.
 */
class AspectoAcademicoSearch extends AspectoAcademico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_asp_acad_esp', 'id_ficha', 'num_matricula'], 'integer'],
            [['curso_in', 'especialidad','paralelo','zona','repetidor'], 'safe'],
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
        $query = AspectoAcademico::find()->where(['id_ficha' => $idFicha]);

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
            'id_asp_acad_esp' => $this->id_asp_acad_esp,
            //'id_ficha' => $this->id_ficha,
            'num_matricula' => $this->num_matricula,
        ]);

        $query->andFilterWhere(['like', 'curso_in', $this->curso_in])
            ->andFilterWhere(['like', 'paralelo', $this->paralelo])
            //->andFilterWhere(['like', 'especialidad', $this->especialidad])
            ->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'repetidor', $this->repetidor]);

        return $dataProvider;
    }
}
