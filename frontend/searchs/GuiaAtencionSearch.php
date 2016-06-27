<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\GuiaAtencion;

/**
 * GuiaAtencionSearch represents the model behind the search form about `frontend\models\GuiaAtencion`.
 */
class GuiaAtencionSearch extends GuiaAtencion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_guia_atencion'], 'integer'],
            [['id_alumno', 'curso', 'paralelo', 'fecha', 'nueva_cita', 'evaluacion_atencion'], 'safe'],
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
        $query = GuiaAtencion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['idAlumno']);
        $query->joinWith(['idReferenciaFamiliar']);

        $query->andFilterWhere([
            'id_guia_atencion' => $this->id_guia_atencion,
            //'id_alumno' => $this->id_alumno,
            'fecha' => $this->fecha,
            'nueva_cita' => $this->nueva_cita,
        ]);

        //->andFilterWhere(['like', "concat(nombres,' ',apellidos))", $this->id_referencia_familiar])
            $query->andFilterWhere(['like', 'curso', $this->curso])
            ->andFilterWhere(['like', 'paralelo', $this->paralelo])
            ->andFilterWhere(['like', 'asunto', $this->asunto])
            ->andFilterWhere(['like', 'proceso', $this->proceso])
            ->andFilterWhere(['like', 'diagnostico', $this->diagnostico])
            ->andFilterWhere(['like', "concat(nombre,' ',concat(apellido_paterno,' ',apellido_materno))", $this->id_alumno])
            ->andFilterWhere(['like', 'evaluacion_atencion', $this->evaluacion_atencion])
            ->andFilterWhere(['like', 'conclusion', $this->conclusion]);

        return $dataProvider;
    }
}
