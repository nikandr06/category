<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Управление категориями',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
);

?>

<h2>Управление категориями</h2>

 <?php  echo  CHtml::beginForm($url, 'Post', array( 'id'=>'edit-form'));   ?>

<h2>Таблица  категорий</h2>
            <div class="main">
                <table class="full-width">
                    <thead>
                        <tr>
                            <?php
                                 foreach( $hearder as $content)      { echo CHtml::tag('th', array(), $content, TRUE);            }  
                             ?>       
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                     foreach ($query as $row)
                     { 
                               echo '<tr>';
                               echo $row;
//                          foreach ($row[0] as $value)    echo "<td>".$value."</td>\n";
                            echo  "\n</tr>";
                     }    
                     ?>
                    </tbody>
                </table>
                
            </div>
            
             <?php       echo CHtml::submitButton('Редактировать',array('name'=>'categ_form',"class"=>"green" )); ?>
        <?php  $this->widget('CLinkPager', array('pages'=>$pages))?> 
          <?php         echo  CHtml::endForm();  ?>
             
