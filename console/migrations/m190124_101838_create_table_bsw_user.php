<?php

use yii\db\Migration;

class m190124_101838_create_table_bsw_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'confirmed_at' => $this->integer(),
            'unconfirmed_email' => $this->string(),
            'blocked_at' => $this->integer(),
            'registration_ip' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'flags' => $this->integer()->notNull(),
            'last_login_at' => $this->integer(),
            'class_old' => $this->integer()->unsigned(),
            'class_new' => $this->integer()->unsigned(),
            'year_old' => $this->integer(),
            'year_new' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('class_old_idx1', '{{%user}}', 'class_old');
        $this->createIndex('class_old_idx', '{{%user}}', 'class_old');
        $this->createIndex('class_new_idx', '{{%user}}', 'class_new');
        $this->createIndex('class_new_idx1', '{{%user}}', 'class_new');
        $this->createIndex('bsw_user_unique_email', '{{%user}}', 'email', true);
        $this->createIndex('bsw_user_unique_username', '{{%user}}', 'username', true);
        $this->addForeignKey('user2classold', '{{%user}}', 'class_old', '{{%classroom}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('user2classnew', '{{%user}}', 'class_new', '{{%classroom}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
