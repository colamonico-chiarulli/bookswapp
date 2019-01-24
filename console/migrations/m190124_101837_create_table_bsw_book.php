<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_book extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey()->unsigned(),
            'isbn' => $this->bigInteger()->notNull(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string(),
            'authors' => $this->string()->notNull(),
            'num_vol_serie' => $this->decimal(),
            'num_volume' => $this->decimal(),
            'published_date' => $this->date(),
            'price' => $this->decimal()->notNull(),
            'annexes' => $this->tinyInteger()->notNull(),
            'page_count' => $this->smallInteger()->unsigned(),
            'thumbnail' => $this->string(),
            'google_book_id' => $this->string(),
            'publisher_id' => $this->integer()->unsigned()->notNull(),
            'print_type_id' => $this->tinyInteger()->unsigned()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_book_publisher1_idx', '{{%book}}', 'publisher_id');
        $this->createIndex('fk_book_print_type1_idx', '{{%book}}', 'print_type_id');
        $this->createIndex('isbn_UNIQUE', '{{%book}}', 'isbn', true);
        $this->addForeignKey('fk_book_print_type1', '{{%book}}', 'print_type_id', '{{%print_type}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_book_publisher1', '{{%book}}', 'publisher_id', '{{%publisher}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
