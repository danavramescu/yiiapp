<?php

/**
 * This is the model class for table "tbl_articles".
 *
 * The followings are the available columns in table 'tbl_articles':
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $publishedAt
 * @property string $imgUrl
 * @property string $description
 */
class Articles extends CActiveRecord
{
	public $image;
	const FOLDER_IMAGE = '/public/images/';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_articles';
	}



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, author, publishedAt', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.			
			array('id, title, description', 'safe', 'on'=>'search'),
			array('description, image', 'safe'),
			array('publishedAt, author', 'unsafe')
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
			'title' => 'Title',
			'author' => 'Author',
			'publishedAt' => 'Published At',
			'imgUrl' => 'Image URL',
			'description' => 'Description',
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true, 'OR');
		$criteria->compare('author',$this->author,true);
		$criteria->compare('publishedAt',$this->publishedAt,true);
		$criteria->compare('description',$this->description,true, 'OR');
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
            	'defaultOrder'=>'id ASC',
			),
			'pagination'=>array(
				'pageSize'=>20
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Articles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

