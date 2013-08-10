<?php
$url_redir= Yii::app()->createUrl("category/admin",array('start_page'=>$nom_page,'kod'=>$kod));    Yii::app()->session['url_redir']=$url_redir;

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
);

/*$level=0;

foreach($categories as $n=>$category)
{
    if($category->level==$level)
        echo CHtml::closeTag('li')."\n";
    else if($category->level>$level)
        echo CHtml::openTag('ul')."\n";
    else
    {
        echo CHtml::closeTag('li')."\n";

        for($i=$level-$category->level;$i;$i--)
        {
            echo CHtml::closeTag('ul')."\n";
            echo CHtml::closeTag('li')."\n";
        }
    }

    echo CHtml::openTag('li');
    echo CHtml::encode($category->title);
    $level=$category->level;
}

for($i=$level;$i;$i--)
{
    echo CHtml::closeTag('li')."\n";
    echo CHtml::closeTag('ul')."\n";
}*/

?>
            <a href="<?php echo Yii::app()->createUrl('category/create'); ?>" class="btn btn-large btn-block btn-primary">Создать категорию</a>
            <h1>Управление категориями (админка)</h1>
            <table class="table table-striped table-bordered">
                <thead><tr>
                <th>id</th>
                <th>Название</th>
                <th>Номер</th>
                <th>Левел</th>
                <th>Парент</th>
                <th>Root</th>
                <th>Действия</th>
            </tr></thead>
            <tbody>
<?php
foreach ($categores as $category) {
       $view_element = 'category_id'.$category['id'];
       echo '<tr id="'.$view_element.'">';
       echo '<td>'.$category['id'].'</td>';
       echo '<td>'.$category['title'].'</td>';
       $data_row=array('id'=>$category['id'], 'nom'=>$category['nom'],'root'=>$category['root'],
           'level'=>$category['level'],'parent'=>$category['parent'],'start_page'=>$nom_page,'kod'=>$kod);
       $url_down= Yii::app()->createUrl('category/down', $data_row);
       $url_up= Yii::app()->createUrl('category/up', $data_row);
       $url_update= Yii::app()->createUrl('category/update', array('id'=>$category['id']));
       echo '<td>'.$category['nom'].
               CHtml::link('Up',$url_up ).'&nbsp;'.
               CHtml::link('Down',$url_down).'</td>';
       echo '<td>'.$category['level'].'</td>';
       echo '<td>'.$category['parent'].'</td>';
       echo '<td>'.$category['root'].'</td>';
       echo '<td><a href="'.$url_update.'" title="Править">
                           <i class="icon-edit"></i></a>
                        <span>&nbsp;</span>';
       if( $category['flag_del'])
       {
         $url_del=Yii::app()->createUrl('category/delete', array('id'=>$category['id'],'nom'=>$category['nom']));
         echo CHtml::ajaxLink('<i class="icon-remove"></i>',$url_del , 
                array('replace'=>'#'.$view_element),
                array("id"=>'dellink_'.$category['id'],'title'=>'Удалить','confirm'=>'Вы действительно хотите удалить?'));
       }
       echo '</td>';
       echo '</tr>';
       
}
               
?>
            </tbody>
            </table>
     <div class="pagination">
<?php  echo $pages; ?>
   </div>
