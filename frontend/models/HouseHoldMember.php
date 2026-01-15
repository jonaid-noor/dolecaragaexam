<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house_hold_member".
 *
 * @property int $id
 * @property int $fk_household_id
 * @property string|null $child_name
 * @property string|null $birth_date
 * @property string|null $sex
 * @property string|null $civil_status
 *
 * @property Household $fkHousehold
 */
class HouseHoldMember extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house_hold_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['child_name', 'birth_date', 'sex', 'civil_status'], 'default', 'value' => null],
            [['fk_household_id'], 'required'],
            [['fk_household_id'], 'integer'],
            [['child_name', 'sex', 'civil_status'], 'string', 'max' => 255],
            [['birth_date'], 'string', 'max' => 50],
            [['fk_household_id'], 'exist', 'skipOnError' => true, 'targetClass' => Household::class, 'targetAttribute' => ['fk_household_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_household_id' => 'Fk Household ID',
            'child_name' => 'Child Name',
            'birth_date' => 'Birth Date',
            'sex' => 'Sex',
            'civil_status' => 'Civil Status',
        ];
    }

    /**
     * Gets query for [[FkHousehold]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkHousehold()
    {
        return $this->hasOne(Household::class, ['id' => 'fk_household_id']);
    }

}
