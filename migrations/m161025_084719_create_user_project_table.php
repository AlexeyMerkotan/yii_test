<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_project`.
 */
class m161025_084719_create_user_project_table extends Migration
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


        $this->createTable('{{%user_project}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->defaultValue(null),
            'id_project' => $this->integer()->defaultValue(null),
        ],$tableOptions);


        $this->addForeignKey('fk_user_user_project', '{{%user_project}}', 'id_user', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_project_user_project', '{{%user_project}}', 'id_project', '{{%project}}', 'id', 'SET NULL', 'CASCADE');


        //$this->addForeignKey('fk_user_country', '{{%user}}', 'country_id', '{{%country}}', 'id', 'SET NULL', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_project');
    }
}
