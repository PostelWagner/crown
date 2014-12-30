<?php



namespace app\widgets\workers;


use app\models\Worker;
use yii\db\Expression;


class Workers extends \yii\base\Widget
{
    public $section;
    public $limit = 4;
    public $order;

public function run()
    {
    if (!isset($this->order)) $this->order=new Expression('RAND()');
    $dataQuery = Worker::find()->orderBy($this->order)->limit($this->limit);
    if ($this->section) {
        $workers = $dataQuery->where('section_id = :section',['section'=>$this->section])->all();
    }
    else {
         $workers = $dataQuery->all();
    }
        
        echo $this->render('mainpagelist',[
            'data' => $workers
            ]);
    }

}
