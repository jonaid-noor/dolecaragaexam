<?php

use yii\db\Migration;

class m260115_032032_add_fk_household_member_to_household extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_household_member_household', 
            '{{%house_hold_member}}',       
            'fk_household_id',              
            '{{%household}}',             
            'id',                       
            'CASCADE',                   
            'RESTRICT'                 
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_household_member_household',
            '{{%house_hold_member}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260115_032032_add_fk_household_member_to_household cannot be reverted.\n";

        return false;
    }
    */
}
