<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Event model
 */
class Event extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%linkedevents}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_event_full', 'data_source', 'image', 'alt_labels', 'name_fi', 'name_en', 'name_sv', 'link', 'context', 'type'], 'string'],
			[['created_time', 'last_modified_time'], 'datetime',  'format' => 'yyyy-MM-dd HH:mm:ss'],
            [['id_event'], 'number'], 
            [['aggregate'], 'boolean']
        ];
    }
	
	/**
    * @inheritdoc
    */
	public function attributeLabels()
    {
        return [
			'name_fi' => 'FI',
			'name_sv' => 'SV',
			'name_en' => 'EN',
			'created_time' => 'Created time',
			'last_modified_time' => 'Last modified',
			'aggregate' => 'aggregate',
        ];
    }
	
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
	
	public function beforeValidate() {
		
		if(parent::beforeValidate()) {
			// $formatter = \Yii::$app->formatter;
			// $formatter->datetimeFormat = 'YYYY-MM-d HH:mm:ss';
			
			// $this->last_modified_time = $formatter->asDatetime(date('Y-m-d H:i:s'));
			// $this->created_time = $formatter->asDatetime($this->created_time);
			// var_dump($this->last_modified_time);  die();
			return true;
		}
		die();
		return false;

	}
}
