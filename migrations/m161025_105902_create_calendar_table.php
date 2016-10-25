<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calendar`.
 */
class m161025_105902_create_calendar_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%calendar}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_project' => $this->integer()->notNull(),
            'start_at' => $this->integer()->notNull(),
            'end_at' => $this->integer()->notNull(),
            'comment' => $this->text()->defaultValue(null),
        ],$tableOptions);



        $this->addForeignKey('fk_calendar_user', '{{%calendar}}', 'id_user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_calendar_project', '{{%calendar}}', 'id_project', '{{%project}}', 'id', 'CASCADE', 'CASCADE');

    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('calendar');
    }
}
