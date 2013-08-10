<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property integer $author_id
 */
class Post extends CActiveRecord
{
    const STATUS_DRAFT=1;
    const STATUS_PUBLISHED=2;
    const STATUS_ARCHIVED=3;
    private $_oldTags;
//    public $Id;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post}}';
	}

        public function scopes()
        {
            return array(
                'sitemap'=>array('select'=>'id', 'condition'=>'create_time <= NOW()', 'order'=>'update_time ASC'),
            );
        }
        public function getPostId()
        {
           return $this->id;
        }

        /** возвращает url*/
        public function getUrl()
        {
           return Yii::app()->createUrl('post/view', array(
              'id'=>$this->id,
              'title'=>$this->title,
          ));
        }

        /** перекрытие метода beforeSave*/
        protected function beforeSave()
        {
          if(parent::beforeSave())
          {
            $pos = mb_strpos($this->content,'<hr id="readmore" />');
            if ($pos>0) {
              $this->description = mb_substr($this->content, 0, $pos);
            }
            else $this->description=$this->content;
            
             $time=new CDbExpression('NOW()'); 
             if($this->isNewRecord)
             {
               $this->create_time=$this->update_time=$time;
               $this->author_id=Yii::app()->user->id;
             }
             else
               $this->update_time=$time;
             return true;
          }
          else
           return false;
        }
        
        protected function afterSave()
        {
            parent::afterSave();
            Tag::model()->updateFrequency($this->_oldTags, $this->tags);
        }
 
 
        protected function afterFind()
        {
           parent::afterFind();
           $this->_oldTags=$this->tags;
        }

     protected function afterDelete()
     {
        parent::afterDelete();
        Comment::model()->deleteAll('post_id='.$this->id);
        Tag::model()->updateFrequency($this->tags, '');
      }
        
        /**
	 * @return array validation rules for model attributes.
	 */
    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
    return array(
        array('title, content, status, id_category', 'required','message'=>'Поле обязательно для заполнения'),
        array('title', 'length', 'max'=>128),
        array('status', 'in', 'range'=>array(1,2,3)),
//        array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/',
//        array('tags', 'match', 'pattern'=>'~^(\p{L}|\p{Zs})+$~u',
        array('tags', 'match', 'pattern'=>'~^(\p{L}|\p{Zs}|,|-|_)+$~u',
//        array('tags', 'match', 'pattern'=>'~^(p{L}|p{Zs}|p{N}|,|-|_)+$~u',
            'message'=>'В тегах можно использовать только буквы.'),
        array('tags', 'normalizeTags'),
 
        array('title, status', 'safe', 'on'=>'search'),
    );
/*		return array(
			array('title, content, tags, status, create_time, update_time, author_id', 'required'),
			array('status, author_id', 'numerical', 'integerOnly'=>true),
			array('title, tags', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, tags, status, create_time, update_time, author_id', 'safe', 'on'=>'search'),
		);*/
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
            return array(
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'id_category'),
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id',
               'condition'=>'comments.status='.Comment::STATUS_APPROVED,
               'order'=>'comments.create_time DESC'),
            'commentCount' => array(self::STAT, 'Comment', 'post_id',
              'condition'=>'status='.Comment::STATUS_APPROVED),
            );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_category' => 'Категория',
			'title' => 'Заголовок',
			'description' => 'Описание',
			'content' => 'Текст',
			'tags' => 'Теги',
			'status' => 'Статус',
			'create_time' => 'Время создания',
			'update_time' => 'Время обновления',
			'author_id' => 'Автор',
		);
	}

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
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('author_id',$this->author_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('post/index', 'tag'=>$tag));
		return $links;
	}
        
        public function normalizeTags($attribute,$params)
        {
          $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
        } 
        	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
		if(Yii::app()->params['commentNeedApproval'])
			$comment->status=Comment::STATUS_PENDING;
		else
			$comment->status=Comment::STATUS_APPROVED;
		$comment->post_id=$this->id;
		return $comment->save();
	}
   

}