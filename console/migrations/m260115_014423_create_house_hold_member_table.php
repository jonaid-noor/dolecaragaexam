<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%house_hold_member}}`.
 */
class m260115_014423_create_house_hold_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%house_hold_member}}', [
            'id' => $this->primaryKey(),
            'fk_household_id' => $this->integer()->notNull(),
            'child_name' => $this->string(255)->null(),
            'birth_date' => $this->string(50)->null(),
            'sex' => $this->string(255)->null(),
            'civil_status' => $this->string(255)->null(),
        ]);

        // Create index for FK
        $this->createIndex(
            'idx-house_hold_member-fk_household_id',
            '{{%house_hold_member}}',
            'fk_household_id'
        );

        // Add foreign key (one household → many members)
        $this->addForeignKey(
            'fk-house_hold_member-household',
            '{{%house_hold_member}}',
            'fk_household_id',
            '{{%household}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-house_hold_member-household',
            '{{%house_hold_member}}'
        );

        $this->dropIndex(
            'idx-house_hold_member-fk_household_id',
            '{{%house_hold_member}}'
        );

        $this->dropTable('{{%house_hold_member}}');
    }
}
