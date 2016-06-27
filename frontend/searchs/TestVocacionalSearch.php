<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TestVocacional;

/**
 * TestVocacionalSearch represents the model behind the search form about `frontend\models\TestVocacional`.
 */
class TestVocacionalSearch extends TestVocacional
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_test_vocacional', 'id_encuesta'], 'integer'],
            [[ 'id_alumno'], 'string'],
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
        $query = TestVocacional::find();

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
            'id_test_vocacional' => $this->id_test_vocacional,
            'id_encuesta' => $this->id_encuesta,
            //'id_alumno' => $this->id_alumno,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'test_vocacional.id_alumno' =>  Yii::$app->db->createCommand("select id_alumno from alumno where id_user=".Yii::$app->user->id)->queryScalar()

        ]);
        $query->andFilterWhere(['like', "concat(nombre,' ',concat(apellido_paterno,' ',apellido_materno))", $this->id_alumno]);


        return $dataProvider;
    }
}
