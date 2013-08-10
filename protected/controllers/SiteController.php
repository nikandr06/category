<?php

class SiteController extends Controller
{
	public $layout='//layouts/blog';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
                        'sitemap'=>array(
                            'class'=>'ext.sitemap.ESitemapAction',
                            'importListMethod'=>'getBaseSitePageList',
                            'classConfig'=>array(
                                array('baseModel'=>'Post',
                                      'route'=>'/post/view',
                                      'params'=>array('id'=>'id')),         
                            ),              
                        ),
                        'sitemapxml'=>array(
                            'class'=>'ext.sitemap.ESitemapXMLAction',
                            'classConfig'=>array(
                                array('baseModel'=>'Post',
                                      'route'=>'/post/view',
                                      'params'=>array('id'=>'id')),         
                                      'scopeName'=>'sitemap'
                            ),
                            //'bypassLogs'=>true, // if using yii debug toolbar enable this line
                            'importListMethod'=>'getBaseSitePageList',
//                            'import'=>array('post.models.*'),
                        ), 
		);
	}

        /**
         * Provide the static site pages which are not database generated
         *
         * Each array element represents a page and should be an array of
         * 'loc', 'frequency' and 'priority' keys
         * 
         * @return array[]
         */
        public function getBaseSitePageList(){

            $list = array(
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/'),
                            'frequency'=>'weekly',
                            'priority'=>'1',
                            ),
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/contact'),
                            'frequency'=>'yearly',
                            'priority'=>'0.8',
                            ),
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/page', array('view'=>'about')),
                            'frequency'=>'monthly',
                            'priority'=>'0.8',
                            ),
 /*                       array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/page', array('view'=>'privacy')),
                            'frequency'=>'yearly',
                            'priority'=>'0.3',
                            ),*/
                    );
            return $list;
        }
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        Yii::app()->createController('Post');
        $this->render('index',array(
          'dataProvider'=>PostController::selectPosts(),
        ));
//		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers = 'From: '.$model->email."\n";
                $headers .= 'Reply-To: '.$model->email."\n";
                $headers .= "Content-type: text/plain; charset=\"utf-8\";"."\n";
                $headers .="Content-Transfer-Encoding: base64"."\n";
                $headers .= 'X-Mailer: PHP/' . phpversion()."\n";
                     
                             $subject='=?utf-8?B?'.base64_encode($model->subject).'?=';
		   //          $subject=mb_encode_mimeheader($model->subject,'utf-8','B');
                             $body=base64_encode($model->body);
            //        $admin_email=Yii::app()->params['adminEmail'];         
//				if (mail($admin_email,$subject,$body,$headers))
				if (mail(Yii::app()->params['adminEmail'],$subject,$body,$headers))
			    	Yii::app()->user->setFlash('contact','Спасибо. В ближайшее время я постараюсь Вам ответить');
                else
			    	Yii::app()->user->setFlash('contact','При отправке письма произошла ошибка');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionShow_sitemap() {
                // Создаём класс.
                $sitemap = new Sitemap();

                $url = $this->createAbsoluteUrl('/');
                // Добавим страничку
                $sitemap->addItem(new SitemapItem(
                  $url, // URL.
                  time(), // Время в формате timestamp.
                  SitemapItem::daily, //Частота обновления (константы класса SitemapItem).
                  0.7 // Приоритет страницы.
                ));

                // Добавим все остальные страницы сайта.
                $posts=Post::model()->findAll();
                foreach($posts as $post){
                  $sitemap->addItem(new SitemapItem(
                    $url.$post->url,
                    strtotime($post->update_time),
                    SitemapItem::monthly
                  ));
                }

                // Сгенерим sitemap в файл sitemap.xml.
                // Если файл не указать - generate вернёт строку.
                $sitemap->generate('sitemap.xml');            
        }
}