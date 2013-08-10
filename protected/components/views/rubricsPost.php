	<?php 
  /*      $rubrics=Category::items();
        foreach($rubrics as $id=>$rubrica): ?>
	<li>
           <?php echo CHtml::link(CHtml::encode($rubrica), '/category/view/id/'.$id); ?>
	</li>
	<?php endforeach; */
        echo '<div id="rubrics">'.$this->getRubricsPost().'</div>';
    ?>