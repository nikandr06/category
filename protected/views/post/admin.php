<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
);

 ?>
            <a href="<?php echo Yii::app()->createUrl('post/create'); ?>" class="btn btn-large btn-block btn-primary">Создать запись</a>
            <h1>Управление услугами (админка)</h1>
            <table class="table table-striped table-bordered">
                <thead><tr>
                <th>id</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Тэги</th>
                <th>Статус</th>
                <th>Время создания</th>
                <th>Действия</th>
            </tr></thead>
            <tbody>
<?php
foreach ($posts as $post) {
       $view_element = 'post_id'.$post['id'];
       echo '<tr id="'.$view_element.'">';
       echo '<td>'.$post['id'].'</td>';
       echo '<td>'.$post['title'].'</td>';
       echo '<td>'.$post['description'].'</td>';
       echo '<td>'.$post['tags'].'</td>';
       echo '<td>'.$post['status'].'</td>';
       echo '<td>'.$post['create_time'].'</td>';
       echo '<td><a href="'.Yii::app()->createUrl('post/update', array('id'=>$post['id'])).'" title="Править">
                           <i class="icon-edit"></i></a>
                        <span>&nbsp;</span>';
                  echo CHtml::ajaxLink('<i class="icon-remove"></i>',
                Yii::app()->createUrl('post/delete', array('id'=>$post['id'])), 
                array('replace'=>'#'.$view_element),
                array("id"=>'dellink_'.$post['id'],'title'=>'Удалить','confirm'=>'Вы действительно хотите удалить?'));
   /*               echo CHtml::Link('<i class="icon-remove"></i>',
                Yii::app()->createUrl('post/delete', array('id'=>$post['id'])), 
                array("id"=>'dellink_'.$post['id'],'title'=>'Удалить','confirm'=>'Вы действительно хотите удалить?'));*/
       echo '</td>';
       echo '</tr>';
       
}
               
?>
            </tbody>
            </table>
            <div class="pagination">
<?php
// рисуем пейджер
    $this->widget('CLinkPager', array(
    'pages' => $pages,
    'maxButtonCount'=>3,
    'cssFile'=>false,
    'hiddenPageCssClass'=>'disabled',
    'header'=>'',
    'selectedPageCssClass'=>'active',
  //  'htmlOptions'=>array('class'=>'pagination')
   ))
?>
</div>
