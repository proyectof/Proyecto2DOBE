<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\GuiaEvaluacion;

/**
 * GuiaEvaluacionSearch represents the model behind the search form about `frontend\models\GuiaEvaluacion`.
 */
class GuiaEvaluacionSearch extends GuiaEvaluacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_guia_evaluacion', 'id_encuesta'], 'integer'],
            [['id_alumno', 'id_referencia_familiar'], 'string'],
            [['fecha', 'hora'], 'safe'],
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
        $query = GuiaEvaluacion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['idAlumno','idReferenciaFamiliar']);

        $query->andFilterWhere([
            'id_guia_evaluacion' => $this->id_guia_evaluacion,
            'id_encuesta' => $this->id_encuesta,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            //'id_alumno' => $this->id_alumno,
            //'id_referencia_familiar' => $this->id_referencia_familiar,
        ]);

        $query->andFilterWhere(['like', "concat(nombre,' ',concat(apellido_paterno,' ',apellido_materno))", $this->id_alumno]);
        $query->andFilterWhere(['like', "concat(nombres,' ',apellidos)", $this->id_referencia_familiar]);

        return $dataProvider;
    }
}
