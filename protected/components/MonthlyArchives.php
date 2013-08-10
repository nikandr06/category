<?php
Yii::import('zii.widgets.CPortlet');

class MonthlyArchives extends CPortlet
{
  public $title='Архив статей c';
  public $maxItems=10;

  public function findAllMaterialDate()
  {
    $yearmonth = array();
    $materials=Post::model()->findAll( array( 'order'=>'update_time','limit'=>$this->maxItems ));
//    $materials = Material::model()->findRecentMaterials($this->maxItems);

    $count = 0;
    foreach ($materials as $material) {
 //       $month=$material->create_time;
//       $ym = Yii::app()->dateFormatter->format("MMMM y",$material->create_time);
      $ym = date('F Y', strtotime($material->create_time)); // December 2011
      if (!isset($yearmonth[$ym])) {
        if (++$count > $this->maxItems) break;
        $yearmonth[$ym] = 1;
      } else {
        $yearmonth[$ym]++;  // 2, 3, 4
      }
    }
    return $yearmonth;
  }

  protected function renderContent()
  {
    $this->render('monthlyArchives');
  }

}