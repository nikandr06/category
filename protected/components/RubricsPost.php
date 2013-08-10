<?php

Yii::import('zii.widgets.CPortlet');

class RubricsPost extends CPortlet
{
	public $title='Рубрики блога';

	public function getRubricsPost()
	{
            $result_menu='<ul class="nav nav-tabs nav-stacked">';
            $res=Category::model()->findAll( array( 'order'=>'nom','condition'=>'parent=:par','params'=>array(':par'=>0) ));
            foreach( $res as $row)
            { Category::rubrics_menu($row, $result_menu); 
            }
            $result_menu.='</ul>';
		return $result_menu;
	}

	protected function renderContent()
	{
		$this->render('rubricsPost');
	}
}