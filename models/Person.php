<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $birth_date
 * @property string $zip_code
 * @property integer $created_at
 * @property integer $updated_at
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'birth_date', 'zip_code'], 'required'],
            [['birth_date'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 32],
            [['zip_code'], 'string', 'max' => 16],
            [['birth_date'], 'default', 'value' => null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getFullName(){
        return sprintf('%s %s',$this->firstname,$this->lastname);
    }

    public function behaviors(){
        return [
            TimestampBehavior::className()
        ];
    }
}
