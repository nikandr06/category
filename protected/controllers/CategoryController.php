<?php

class CategoryController extends Controller
{
	public $layout='//layouts/blog';

	public function filters()
	{
 	  return array(	'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','up','down'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','admin','RedakKat','FindKat','MoveKat'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        Yii::app()->createController('Post');
        $this->render('view',array(
          'model'=>$this->loadModel($id),
          'dataProvider'=>PostController::selectPosts($id),
        ));
/*		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
	}

	
    public function actionCreate()
    {
            $model=new Category;

            if(isset($_POST['Category']))
            {
                    $model->attributes=$_POST['Category'];
  //print_r($_POST);                    
                    if ($model->parent>0)
                    {
                        $q='select nom,root,level from {{category}} where id='.$model->parent.' ';
                        $r = Yii::app()->db->createCommand($q)->queryRow();
                        $nom = $r['nom'];   
                        $model->root=$r['root'];
                        $model->level=$r['level']+1;
//echo '<br/>nom11='.$nom.' root='.$root.' parent='.$model->parent;
                    }
                    else { 
                        $model->level = 0;
               //         $model->parent = 0;
                        $q='select count(*) as count from {{category}} ';
                        $r = Yii::app()->db->createCommand($q)->queryRow();
                        $nom = $r['count']-1;
                        $q='select root from {{category}} where level=0 order by root desc limit 0,1 ';
                        $r = Yii::app()->db->createCommand($q)->queryRow();
                        $model->root= $r['root']+1;
                    }
//echo '<br/>nom='.$nom.' root='.$root.' parent='.$model->parent;
                    if ($model->validate()) {
                        $q='update {{category}} set nom=nom+1 where nom>'.$nom.' order by nom';
                        Yii::app()->db->createCommand($q)->execute();
                        $model->nom =$nom+1;
                        $model->save(false);
                        $this->redirect(array('view','id'=>$model->id));
                    }
            }
            $this->render('create',array( 'model'=>$model,         ));
    }

    public function actionUpdate($id)
    {
           $model=  $this->loadModel($id);
           $flag_old=FALSE;
            if(isset($_POST['Category']))
            {
                 $model->attributes=$_POST['Category'];
                 if( !isset($_POST['flag_old']) || $_POST['flag_old']==0)   
                 {
                     if(  $model->save(false) )  $this->redirect(Yii::app()->session['url_redir']);
                 }
                 else
                 {
 //    echo '   aaaaa   wwwwww';  print_r($_POST);   exit();
                     $nom_end=Category::find_end($model->nom, $model->level);
                    if ($model->parent>0)
                    {
                        $q='select * from {{category}} where id='.$model->parent;
                        $d_par= Yii::app()->db->createCommand($q)->queryRow();
                        $nom_par=$d_par['nom'];

                        $del_level=$d_par['level']-$model->level+1;
                        $nom_kol=$nom_end-$model->nom;

                        $model->level=$d_par['level']+1;
                        $model->root=$d_par['root'];
                        if ($model->validate()) 
                        {
                            $q='select id from {{category}} where nom>'.$model->nom.' and nom<'.$nom_end;
                            $child= Yii::app()->db->createCommand($q)->queryAll();
                            if( $nom_par<$model->nom)
                            {
                                $q='update {{category}} set nom=nom+'.$nom_kol.'  where nom>'.$nom_par.' and nom<'.$model->nom;
                                Yii::app()->db->createCommand($q)->execute();
                                $del_nom=$nom_par-$model->nom+1;
                                $model->nom=$nom_par+1;
                            }
                            else 
                            {
                                $q='update {{category}} set nom=nom-'.$nom_kol.'  where nom>='.$nom_end.' and nom<='.$nom_par;
                                Yii::app()->db->createCommand($q)->execute();
                                $del_nom=$nom_par-$nom_end+1;
                                $model->nom=$model->nom+$del_nom;
                             }
                          if(is_array($child) && count($child)>0 )
                           {
                               $s=''; foreach ($child as $row) $s.=$row['id'].',';   $s=substr($s, 0,-1);
                               $q='update {{category}} set nom=nom+'.$del_nom.', level=level+'.$del_level.',root= '.$d_par['root'];
                               $q.= '  where id in('.$s.' )';
                               Yii::app()->db->createCommand($q)->execute();
                            }
                           $model->save(false);
                           $this->redirect(Yii::app()->session['url_redir']);
                        }
                    }
                    else { 
                        $nom_par=-1;
                        $del_level=-$model->level;
                        $nom_kol=$nom_end-$model->nom;
                        $model->level=0;
                        if ($model->validate()) 
                        {
                            $q='select id from {{category}} where nom>'.$model->nom.' and nom<'.$nom_end;
                            $child= Yii::app()->db->createCommand($q)->queryAll();

//echo ' nom_kol='.$nom_kol.'$model->nom='.$model->nom.' $nom_end='.$nom_end.' <br/>';print_r($child);  Yii::app()->end();                        

                            $q='update {{category}} set nom=nom+'.$nom_kol.'  where nom>'.$nom_par.' and nom<'.$model->nom;
                            Yii::app()->db->createCommand($q)->execute();
                             $del_nom=$nom_par-$model->nom+1;
                             $model->nom=$nom_par+1;

                            if(is_array($child) && count($child)>0 )
                           {
                               $s=''; foreach ($child as $row) $s.=$row['id'].',';   $s=substr($s, 0,-1);
                               $q='update {{category}} set nom=nom+'.$del_nom.', level=level+'.$del_level;
                               $q.= '  where id in('.$s.' )';
                               Yii::app()->db->createCommand($q)->execute();
                            }
                           $model->save(false);
                           $this->redirect(Yii::app()->session['url_redir']);
                      }
                    }
                 }
//$this->redirect(array('view','id'=>$model->id));
            }
            $this->render('update',array(  'model'=>$model,'flag_old'=>$flag_old ));
    }

    public function actionDelete($id,$nom)
    {
            if(Yii::app()->request->isAjaxRequest)
            {
                    $this->loadModel($id)->delete();
                    $q='update {{category}} set nom=nom-1  where nom>='.$nom;
                    Yii::app()->db->createCommand($q)->execute();
                    echo '<tr></tr>';
            }
            else   throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

////////////////////////////////      
        
   public function actionAdmin($start_page=1,$kod=1)
  {
        $name='Category';      $model=CActiveRecord::model($name);
        $action=Yii::app()->createUrl("Category/admin");
        $data=$this->select($action,$start_page,$kod);
  //      $this->render('index',array(  'data_form'=> $data['values'],'model'=>$model, 'pages'=>$data['pages']));
        $categores=$data['values'];  $kol_all=$data['count'];
            $kol=  count($categores);
            $beg=$categores[0]['level'];
            for($i=1; $i<$kol; $i++)
            {
                $end=$categores[$i]['level'];
                $categores[$i-1]['flag_del']=($end>$beg) ? 0 : 1;
  //print_r($categores[$i-1]);    echo '<br/>';  echo '$end='.$end.'beg='.$beg.'<br/>';
                $beg=$end;
            }
//print_r($categores[$kol-1]['nom']);    echo '<br/>';  echo '$kol_all='.$kol_all.'kol='.$kol.'<br/>';
            
            if($categores[$kol-1]['nom']>=($kol_all-1) )  $categores[$kol-1]['flag_del']=1;
            else unset( $categores[$kol-1]);
            $this->render('admin',array('categores'=>$categores,'nom_page'=>$start_page,'kod'=>$kod,
                        'pages' =>  $data['pages']
                ));
      
  }// end adminMenu__________________________________________ 

      static function select($action,$start_page=1,$kod=1)
    { $q='select count(*) as kol from {{category}} ';
       $count= Yii::app()->db->createCommand( $q)->queryRow();

       $kol=$count['kol'];
       $kol_row=17;  $show_page=12;
       $page_kol=ceil($kol/$kol_row);

       $pagin=HelpKateg::myPaginat($page_kol, $start_page, $show_page, $action, $kod);
       $pages=$pagin['pages'];
       $start_page=$pagin['start_page'];
       $page_tek=$pagin['tek_page'];
       $ofset=($page_tek-1)*$kol_row;
       
         $result= Yii::app()->db->createCommand(
          array(  'select' => 's.*',
                      'from' => '{{category}} s ',
                      'offset' => $ofset,
                      'limit' => $kol_row+1,
                      'order' => 'nom'
          ))->queryAll();

         return  array('values'=>$result,'pages'=>$pages,'count'=>$kol);
        }
        
     public function actionUp($id, $nom,$parent,$level,$root,$start_page,$kod)
     {
            if ($nom>0)
            {
                $q='select * from {{category}} where nom='.($nom-1).' limit 0,1';
                $r = Yii::app()->db->createCommand($q)->queryRow();
                $id_pre = $r['id'];
//echo 'id_pre='.$id_pre.' nom='.$nom.' q='.$q; print_r($r); Yii::app()->end();
                if( $parent==$id_pre)
                {
                  $q='update {{category}} set parent='.$id.' where parent='.$id_pre;
                  Yii::app()->db->createCommand($q)->execute();
                  $q='update {{category}} set parent='.$id_pre.' where parent='.$id.' and level='.($level+1);
                  Yii::app()->db->createCommand($q)->execute();
                  $q='update {{category}} set nom='.$nom.',level='.$level.',root='.$root.',parent='.$id.' where id='.$id_pre;
                  Yii::app()->db->createCommand($q)->execute();
                }
                else
                {
                  $q='select id from {{category}} where parent='.$id;
                  $z = Yii::app()->db->createCommand($q)->queryAll();
                  $q='update {{category}} set parent='.$id.' where parent='.$id_pre;
                  Yii::app()->db->createCommand($q)->execute();
                  if(count($z)>0 && is_array($z) )
                  {
                     $s='';  foreach ($z as $row) $s.=$row['id'].','; $s=  substr($s, 0,-1);
                     $q='update {{category}} set parent='.$id_pre.' where  id in('.$s.')';
                     Yii::app()->db->createCommand($q)->execute();
                  }
   
                  $q='update {{category}} set nom='.$nom.',level='.$level.',root='.$root.',parent='.$parent.' where id='.$id_pre;
                 Yii::app()->db->createCommand($q)->execute();
                }
//echo 'id_pre='.$id_pre.' q='.$q;                
  $q='update {{category}} set nom='.($nom-1).',level='.$r['level'].',root='.$r['root'].',parent='.$r['parent'].' where id='.$id;
  Yii::app()->db->createCommand($q)->execute();
            }
             $this->redirect(Yii::app()->createUrl('category/admin', array('start_page'=>$start_page,'kod'=>$kod)));
    }

         public function actionDown($id, $nom,$parent,$level,$root,$start_page,$kod)
     {
            $q='select * from {{category}} where nom='.($nom+1).' limit 0,1';
            $r = Yii::app()->db->createCommand($q)->queryRow();
            
            if (isset($r['id']) && $r['id']>0)
            {   $id_pre = $r['id'];
                 $q='update {{category}} set nom='.$nom.',level='.$level.',root='.$root.',parent='.$parent.' where id='.$id_pre;
                  Yii::app()->db->createCommand($q)->execute();
//echo ' q='.$q.' id='.$id.' par='.$r['parent'].'  pre='.$id_pre.'<br/>';                  
                if($id==$r['parent'])
                {
                  $q='update {{category}} set parent='.$id.' where parent='.$id_pre;
                  Yii::app()->db->createCommand($q)->execute();
                  $q='update {{category}} set parent='.$id_pre.' where parent='.$id.' and level='.($level+1);
                  Yii::app()->db->createCommand($q)->execute();
//echo ' <br/>. 1-q='.$q;                  

 $q='update {{category}} set nom='.($nom+1).',level='.$r['level'].',root='.$r['root'].',parent='.$id_pre.' where id='.$id;
                 Yii::app()->db->createCommand($q)->execute();
                }
                else
                {
                  $q='select id from {{category}} where parent='.$id;
                  $z = Yii::app()->db->createCommand($q)->queryAll();
//echo ' aaaaaaaaaaaa <br/>. else ='; print_r($z);             
                  $q='update {{category}} set parent='.$id.' where parent='.$id_pre;
                  Yii::app()->db->createCommand($q)->execute();
                  if(count($z)>0 && is_array($z) )
                  {   $s='';  foreach ($z as $row) $s.=$row['id'].','; $s=  substr($s, 0,-1);
                       $q='update {{category}} set parent='.$id_pre.' where  id in('.$s.')';
                       Yii::app()->db->createCommand($q)->execute();
                  }

 $q='update {{category}} set nom='.($nom+1).',level='.$r['level'].',root='.$r['root'].',parent='.$r['parent'].' where id='.$id;
                 Yii::app()->db->createCommand($q)->execute();
//echo ' <br/>. 2-q='.$q;                  
                }
//echo ' <br/>. aaaaaaaaaaaaaa      2-q='.$q;                  
            }
             $this->redirect(Yii::app()->createUrl('category/admin', array('start_page'=>$start_page,'kod'=>$kod)));
    }

    public function loadModel($id)
    {
            $model=Category::model()->findByPk($id);
            if($model===null)    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
        
    
}
