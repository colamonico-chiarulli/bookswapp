<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_bookmark extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%bookmark}}', [
            'user_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->unsigned()->notNull(),
            'reserved' => $this->tinyInteger()->notNull(),
            'date_bookmark' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('fk_user_has_book_book1_idx', '{{%bookmark}}', 'book_id');
        $this->createIndex('fk_user_has_book_user1_idx', '{{%bookmark}}', 'user_id');
        $this->addForeignKey('fk_user_has_book_book1', '{{%bookmark}}', 'book_id', '{{%book}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_has_book_user1', '{{%bookmark}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%bookmark}}');
    }
}
