<?php

/**
 * This is the model class for table "comic".
 *
 * The followings are the available columns in table 'comic':
 * @property integer $id
 * @property string $title
 * @property integer $artist_id
 * @property integer $sequel_to
 * @property string $date
 */
class Comic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, artist_id', 'required'),
			array('artist_id, sequel_to', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, artist_id, sequel_to, date', 'safe', 'on'=>'search'),
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
            "artist"    => array(self::BELONGS_TO, "Artist", "artist_id"),
            "parent"    => array(self::BELONGS_TO, "Comic","sequel_to"),

            'comics_content' => array(self::HAS_MANY, 'ComicsContent', 'comic_id'),
            'pages' => array(self::HAS_MANY,
                'Content', array('content_id'=>'id'),
                'through'=>'comics_content'
            ),
        );
	}

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->date = new CDbExpression('NOW()');
        }


        return parent::beforeSave();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'artist_id' => 'Artist',
			'sequel_to' => 'Sequel To',
			'date' => 'Date',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('artist_id',$this->artist_id);
		$criteria->compare('sequel_to',$this->sequel_to);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
