<?php

namespace frontend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Ficha;

/**
 * FichaSearch represents the model behind the search form about `frontend\models\Ficha`.
 */
class FichaSearch extends Ficha
{
    /**
     * @inheritdoc
     */

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['idAlumno.cedula']);
    }
    
    public function rules()
    {
        return [
            [['id_ficha'], 'integer'],
            [['nombre_completo','fecha_creacion', 'hora_creacion','idAlumno.cedula'], 'safe'],
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
        $query = Ficha::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith([
            'idAlumno' => function($query) { 
                $query->from(['al' => 'alumno']); 
            }
        ]);

        $query->andFilterWhere([
            'ficha.id_ficha' => $this->id_ficha,
            'fecha_creacion' => $this->fecha_creacion,
            'hora_creacion' => $this->hora_creacion,

        ]);

        $query->andFilterWhere(['like', "concat(nombre,' ',concat(apellido_paterno,' ',apellido_materno))", $this->nombre_completo]);
        $query->andFilterWhere([
            'LIKE', 'al.cedula', $this->getAttribute('idAlumno.cedula')."%",false
        ]);

        return $dataProvider;
    }
}
