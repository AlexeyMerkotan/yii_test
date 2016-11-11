<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m161111_082050_create_task_table extends Migration
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


        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_project' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'priority' => $this->integer()->notNull(),
            'task_status' => $this->integer()->notNull(),
            'start_at' => $this->integer()->defaultValue(null),
            'end_at' => $this->integer()->defaultValue(null),
        ],$tableOptions);


        $this->addForeignKey('fk_task_user', '{{%task}}', 'id_user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_task_project', '{{%task}}', 'id_project', '{{%project}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('task');
    }
}
