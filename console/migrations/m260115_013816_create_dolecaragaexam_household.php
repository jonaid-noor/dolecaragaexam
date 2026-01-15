<?php

use yii\db\Migration;

class m260115_013816_create_dolecaragaexam_household extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('household', [
            'id' => $this->primaryKey(),
            'father_name' => $this->string(255)->null(),
            'mother_name' => $this->string(255)->null(),
            'father_occupation' => $this->string(255)->null(),
            'mother_occupation' => $this->string(255)->null(),
            'home_address' => $this->string(500)->null(),
            'family_income' => $this->decimal(20, 2)->null(),
            'house_status' => $this->integer(10)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('household');
        $this->execute("DROP DATABASE IF EXISTS dolecaragaexam");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260115_013816_create_dolecaragaexam_household cannot be reverted.\n";

        return false;
    }
    */
}
