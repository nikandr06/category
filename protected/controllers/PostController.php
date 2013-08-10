<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        private $_model;
	public $layout='//layouts/blog';

	/**
	 * @return array action filters
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
                    );
	}

        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
          return array(
             array('allow',  // allow all users to perform 'list' and 'show' actions
                'actions'=>array('index', 'view', 'captcha'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated users to perform any action
                'users'=>array('@'),
             ),
             array('deny',  // deny all users
               'users'=>array('*'),
            ),
          );
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
//            echo 'cvvcdvdv';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
    public function actionDelete()
    {
      if(Yii::app()->request->isAjaxRequest)
      {
        // we only allow deletion via POST request
        $this->loadModel()->delete();
        
        echo '<tr></tr>';
        
 //       if(!isset($_POST['ajax']))
  //          $this->redirect(array('index'));
      }
      else
          throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
 //       $this->loadModel()->delete();
 //       $this->redirect(Yii::app()->createUrl('post/admin'));
        
     }
     
	/**
	 * Lists all models.
	 */
       public function actionIndex()
      {
        $this->render('index',array(
          'dataProvider'=>$this->selectPosts(),
        ));
      }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
/*		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));*/
//            $posts=Post::model()->findAll();
            $criteria = new CDbCriteria();
 
            $count=Post::model()->count($criteria);

            $pages=new CPagination($count);
            // элементов на страницу
            $pages->pageSize=2;
            $pages->applyLimit($criteria);

            $posts = Post::model()->findAll($criteria);

            $this->render('admin',array(
			'posts'=>$posts,
                        'pages' => $pages
                ));
	}

       public function actionView($id=1)
       {
         $post=$this->loadModel();
         $comment=$this->newComment($post);
 
         $this->render('view',array(
            'model'=>$post,
            'comment'=>$comment,
         ));
        }
 
        protected function newComment($post)
        {
           $comment=new Comment;
 
           if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
           {
              echo CActiveForm::validate($comment);
              Yii::app()->end();
            }
 
           if(isset($_POST['Comment']))
           {
              $comment->attributes=$_POST['Comment'];
              if($post->addComment($comment))
              {
                if($comment->status==Comment::STATUS_PENDING)
                  Yii::app()->user->setFlash('commentSubmitted','Спасибо!');
                $this->refresh();
               }
             }
            return $comment;
          }           
    public function loadModel()
    {
      if($this->_model===null)
      {
        if(isset($_GET['id']))
        {
            if(Yii::app()->user->isGuest)
                $condition='status='.Post::STATUS_PUBLISHED
                    .' OR status='.Post::STATUS_ARCHIVED;
            else
                $condition='';
            $this->_model=Post::model()->findByPk($_GET['id'], $condition);
        }
        if($this->_model===null)
            throw new CHttpException(404,'Запрашиваемая страница не существует.');
      }
      return $this->_model;
    }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        static function selectPosts($id_category=0)
        {
           $criteria=new CDbCriteria(array(
            'condition'=>'status='.Post::STATUS_PUBLISHED,
            'order'=>'update_time DESC',
            'with'=>'commentCount',
          ));
         if(isset($_GET['tag']))
            $criteria->addSearchCondition('tags',$_GET['tag']);
         if($id_category>0)
            $criteria->addSearchCondition('id_category',$id_category);
         if(isset($_GET['time']))
         {
	    $month = date('n', $_GET['time']); // 1 through 12
	    $year = date('Y', $_GET['time']); // 2011
	    if ($_GET['pnc'] == 'n') $month++;
	    if ($_GET['pnc'] == 'p') $month--;
            $firstDay = date("Y-m-d", mktime(0,0,0,$month,1,$year));
            $lastDay = date("Y-m-d", mktime(0,0,0,$month+1,1,$year));
//            echo $lastDay;
            $criteria->addCondition("create_time > DATE('$firstDay')");
            $criteria->addCondition("create_time < DATE('$lastDay')");
//           print_r($criteria);
         }
         
          $dataProvider=new CActiveDataProvider('Post', array(
            'pagination'=>array(
              'pageSize'=>5,
           ),
          'criteria'=>$criteria,
          ));
          return $dataProvider; 
        }

                /**
	         * Возвращает посты в месяце
	         */
	        public function actionPostedInMonth()
	        {
//        $this->render('index',array(
//          'dataProvider'=>$this->selectPosts(),)
 //           );
/*	                $month = date('n', $_GET['time']); // 1 through 12
	                $year = date('Y', $_GET['time']); // 2011
	                if ($_GET['pnc'] == 'n') $month++;
	                if ($_GET['pnc'] == 'p') $month--;

	                $criteria = new CDbCriteria(array(
	                        'condition' => 'status='.Material::STATUS_PUBLISHED.' AND create_time > :time1 AND create_time < :time2',
	                        'order' => 'update_time DESC',
	                        'params' => array(
	                                ':time1' => ($firstDay = date("Y-m-d", mktime(0,0,0,$month,1,$year))),
	                                ':time2' => date("Y-m-d", mktime(0,0,0,$month+1,1,$year))),
	                ));

	                $pages = new CPagination(Material::model()->count($criteria));
	                $pages->pageSize = Yii::app()->params['materialsPerPage'];
	                $pages->applyLimit($criteria);

	                $materials = Material::model()->findAll($criteria);

	                $this->render('month',array(
	                        'materials' => $materials,
	                        'pages' => $pages,
	                        'firstDay' => $firstDay,
	                ));*/
	        }        
}
