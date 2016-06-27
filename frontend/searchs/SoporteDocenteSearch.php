<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SoporteDocente;

/**
 * SoporteDocenteSearch represents the model behind the search form about `frontend\models\SoporteDocente`.
 */
class SoporteDocenteSearch extends SoporteDocente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_soporte_docente'], 'integer'],
            [['id_alumno', 'asignatura', 'curso', 'paralelo', 'fecha', 'comportamiento', 'rendimiento', 'otro', 'diagnostico'], 'safe'],
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
        $query = SoporteDocente::find();

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

        $query->andFilterWhere([
            'id_soporte_docente' => $this->id_soporte_docente,
            //'nombre' => $this->id_alumno,
            'fecha' => $this->fecha,
            'soporte_docente.id_user'=> Yii::$app->user->can("docente") ? Yii::$app->user->id : $this->id_user
        ]);

        $query
            ->andFilterWhere(['like', 'asignatura', $this->asignatura])
            ->andFilterWhere(['like', 'curso', $this->curso])
            ->andFilterWhere(['like', 'paralelo', $this->paralelo])
            ->andFilterWhere(['like', 'comportamiento', $this->comportamiento])
            ->andFilterWhere(['like', 'rendimiento', $this->rendimiento])
            ->andFilterWhere(['like', "concat(nombre,' ',concat(apellido_paterno,' ',apellido_materno))", $this->id_alumno])
            ->andFilterWhere(['like', 'otro', $this->otro])
            ->andFilterWhere(['like', 'diagnostico', $this->diagnostico]);

        return $dataProvider;
    }
}
