<?php

use yii\db\Migration;

/**
 * Handles the creation for table `users`.
 */
class m161019_130818_create_users_table extends Migration
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


        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->defaultValue(null),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'created_at' => $this->integer()->defaultValue(null),
            'updated_at' => $this->integer()->defaultValue(null),
            'status' =>$this->integer(1)->defaultValue(null),
            'color' =>$this->string(6)->defaultValue(null),
            'bithday' =>$this->integer()->defaultValue(null),
            'phone' =>$this->string(50)->defaultValue(null),
            'country_id' => $this->integer()->defaultValue(null),
            'city' => $this->string(100)->defaultValue(null),
            'zip' => $this->string(10)->defaultValue(null),
            'address' => $this->string(100)->defaultValue(null),
            'avatar' =>$this->string()->defaultValue(null),
        ], $tableOptions);

        $this->addForeignKey('fk_user_country', '{{%user}}', 'country_id', '{{%country}}', 'id', 'SET NULL', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_user_country', '{{%user}}');
        $this->dropTable('user');
    }
}
