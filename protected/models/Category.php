<?php


class Category extends CActiveRecord
{
    public $flag_old;
    
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('parent', 'length', 'max'=>10),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent, title', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent' => 'Parent',
			'title' => 'Title',
		);
	}

 /*       public function behaviors()
        {
            return array(
                'nestedSetBehavior'=>array(
                    'class'=>'ext.yiiext.behaviors.model.trees.NestedSetBehavior',
                    'hasManyRoots'=>'true',
                    'rootAttribute'=>'root',
                    'leftAttribute'=>'lft',
                    'rightAttribute'=>'rgt',
                    'levelAttribute'=>'level',
                ),
            );
        }*/
        
        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
        public static function items()
        {
            $models=self::model()->findAll();
           $list = CHtml::listData($models,'id', 'title'); 
            return $list;
        }
 public  static function rubrics_menu($row_menu,&$result_menu)   
 {
       $id=$row_menu['id']; 
       $result_menu.='<li>'.CHtml::link(CHtml::encode($row_menu['title']), '/category/view/id/'.$row_menu['id']);
       $res=self::model()->findAll( array( 'order'=>'nom','condition'=>'parent=:par','params'=>array(':par'=>$id) ));
       foreach( $res as $row)
       { 
         $result_menu.='<ul>';
           self::rubrics_menu($row, $result_menu); 
         $result_menu.='</ul>';
       }
       $result_menu.='</li>';
 }//  end function rubrics_menu()

 public  static function show_category()   
 {
//       $res=self::model()->findAll( array( 'order'=>'number','condition'=>'parent=:par','params'=>array(':par'=>$id) ));
          $model=self::model()->findAll( array( 'order'=>'nom' ));
          $list = CHtml::listData($model,'id', 'title');  
          $a=array('0'=>'Без родителя');
          return $a+$list;
   } 

  public  static function find_end($nom,$level)   
 {     $q='select nom from {{category}} where nom>'.$nom.' and level<='.$level.' order by nom limit 0,1';
        $d= Yii::app()->db->createCommand($q)->queryRow();
        if(is_array($d) && $d['nom']>0)            return $d['nom'];
        else {
          $q='select nom from {{category}} order by  nom desc limit 0,1';
          $d= Yii::app()->db->createCommand($q)->queryRow();
           return $d['nom']+1; 
        }
   } 
   
  public  static function show_category_up($nom,$level)   
 {      $nom_end=Category::find_end($nom, $level);
//echo 'nom'.$nom.' level='.$level.' end'.$nom_end;       
          $model=self::model()->findAll( array( 'order'=>'nom','condition'=>'nom<'.$nom.' or nom>='.$nom_end ));
          $list = CHtml::listData($model,'id', 'title');  
          $a=array('0'=>'Без родителя');
          return $a+$list;
   } 
}