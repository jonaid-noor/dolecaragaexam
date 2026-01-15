<?php

use yii\db\Migration;

class m260115_031650_add_is_delete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    {
        $this->addColumn('{{%household}}', 'is_delete', $this->tinyInteger()->defaultValue(0)->after('house_status'));

        $this->addColumn('{{%house_hold_member}}', 'is_delete', $this->tinyInteger()->defaultValue(0)->after('civil_status'));
    }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop 'is_delete' column from 'household'
        $this->dropColumn('{{%household}}', 'is_delete');

        // Drop 'is_delete' column from 'house_hold_member'
        $this->dropColumn('{{%house_hold_member}}', 'is_delete');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260115_031650_add_is_delete cannot be reverted.\n";

        return false;
    }
    */
}
