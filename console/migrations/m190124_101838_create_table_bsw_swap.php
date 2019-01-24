<?php

use yii\db\Migration;

class m190124_101838_create_table_bsw_swap extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%swap}}', [
            'seller_user_id' => $this->integer()->notNull(),
            'buyer_user_id' => $this->integer(),
            'price_swap' => $this->decimal(),
            'annexes_swap' => $this->tinyInteger(),
            'sold' => $this->tinyInteger(),
            'note_swap' => $this->string(),
            'date_for_sale' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_swap' => $this->dateTime(),
            'book_id' => $this->integer()->unsigned()->notNull(),
            'condition_id' => $this->tinyInteger()->unsigned(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%swap}}', ['book_id', 'seller_user_id']);
        $this->createIndex('fk_swapbuyer_has_user1_idx', '{{%swap}}', 'buyer_user_id');
        $this->createIndex('fk_user_has_book_book1_idx', '{{%swap}}', 'book_id');
        $this->createIndex('fk_swap_has_condition1_idx', '{{%swap}}', 'condition_id');
        $this->createIndex('fk_swapseller_has_user_idx', '{{%swap}}', 'seller_user_id');
        $this->addForeignKey('fk_transaction_has_book1', '{{%swap}}', 'book_id', '{{%book}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('swap2userb', '{{%swap}}', 'buyer_user_id', '{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('swap2users', '{{%swap}}', 'seller_user_id', '{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_book_has_condition1', '{{%swap}}', 'condition_id', '{{%condition}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%swap}}');
    }
}
