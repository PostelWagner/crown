<?php



namespace app\widgets\workers;


use app\models\Worker;
use yii\db\Expression;


class AjaxAction extends \yii\base\Widget
{
    public $action;
    public $form_id;
    public $form_template;
    public $form_type;

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
