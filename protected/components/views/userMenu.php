<ul class="nav nav-tabs nav-stacked">
    <li><?php echo CHtml::link('Создать новую запись',array('post/create')); ?></li>
    <li><?php echo CHtml::link('Управление записями',array('post/admin')); ?></li>
    <li><?php echo CHtml::link('Управление категориями',array('category/admin')); ?></li>
    <li><?php echo CHtml::link('Одобрение комментариев'. ' (' . Comment::model()->pendingCommentCount . ')',
            array('comment/index')); ?></li>
    <li><?php echo CHtml::link('Выход',array('site/logout')); ?></li>
</ul>