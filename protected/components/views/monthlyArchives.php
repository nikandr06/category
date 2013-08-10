<div id="materialsHeader">
<!--    <div id="materials" class="portlet-materials">
        <h3>Архив статей</h3>
-->		
		<ul class="nav nav-list">
		<?php foreach ($this->findAllMaterialDate() as $month=>$val): ?>
			<li>
			<?php 
                          $time=Yii::app()->dateFormatter->format("MMMM y",$month);
                          echo CHtml::link("$time ($val)", array('post/index',
                               'time'=>strtotime($month),
                 		'pnc'=>'c'));  ?>
			</li>
		<?php endforeach; ?>
		</ul>
<!--	</div>
	<div id="materialsFooter"></div>-->
</div>