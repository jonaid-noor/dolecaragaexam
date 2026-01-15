<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "household".
 *
 * @property int $id
 * @property string|null $father_name
 * @property string|null $mother_name
 * @property string|null $father_occupation
 * @property string|null $mother_occupation
 * @property string|null $home_address
 * @property float|null $family_income
 * @property string|null $house_status
 *
 * @property HouseHoldMember[] $houseHoldMembers
 */
class Household extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'household';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['father_name', 'mother_name', 'father_occupation', 'mother_occupation', 'home_address', 'family_income'], 'default', 'value' => null],
            [['family_income'], 'number'],
            [['house_status'], 'required'],
            [['father_name', 'mother_name', 'father_occupation', 'mother_occupation', 'house_status'], 'string', 'max' => 255],
            [['home_address'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'father_name' => 'Father`s Name',
            'mother_name' => 'Mother`s Name',
            'father_occupation' => 'Father` Occupation',
            'mother_occupation' => 'Mother`s Occupation',
            'home_address' => 'Home Address',
            'family_income' => 'Family Income',
            'house_status' => 'House Status',
        ];
    }

    /**
     * Gets query for [[HouseHoldMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHouseHoldMembers()
    {
        return $this->hasMany(HouseHoldMember::class, ['fk_household_id' => 'id']);
    }

}
