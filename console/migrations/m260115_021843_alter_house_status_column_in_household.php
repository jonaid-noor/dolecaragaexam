<?php

use yii\db\Migration;

class m260115_021843_alter_house_status_column_in_household extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%household}}', 'house_status', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%household}}', 'house_status', $this->integer(10)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260115_021843_alter_house_status_column_in_household cannot be reverted.\n";

        return false;
    }
    */
}
