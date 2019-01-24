<?php

use yii\db\Migration;

class m190124_101836_create_table_bsw_adoption extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adoption}}', [
            'id' => $this->primaryKey()->unsigned(),
            'school_id' => $this->integer()->unsigned()->notNull(),
            'year_adoption' => $this->date()->notNull(),
            'classroom_id' => $this->integer()->unsigned()->notNull(),
            'book_id' => $this->integer()->unsigned()->notNull(),
            'owned' => $this->tinyInteger()->notNull(),
            'to_buy' => $this->tinyInteger()->notNull(),
            'advised' => $this->tinyInteger()->notNull(),
            'price_adoption' => $this->decimal()->notNull(),
            'subject_id' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_adoption_class1_idx', '{{%adoption}}', 'classroom_id');
        $this->createIndex('fk_adoption_subject1_idx', '{{%adoption}}', 'subject_id');
        $this->createIndex('fk_adoption_book1_idx', '{{%adoption}}', 'book_id');
        $this->createIndex('adoption_school_year_class_book', '{{%adoption}}', ['school_id', 'year_adoption', 'classroom_id', 'book_id'], true);
        $this->addForeignKey('fk_adoption_subject1', '{{%adoption}}', 'subject_id', '{{%subject}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_adoption_book1', '{{%adoption}}', 'book_id', '{{%book}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_adoption_classroom_class', '{{%adoption}}', 'classroom_id', '{{%classroom}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_adoption_school_school', '{{%adoption}}', 'school_id', '{{%school}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%adoption}}');
    }
}
