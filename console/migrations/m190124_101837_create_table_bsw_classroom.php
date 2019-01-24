<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_classroom extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%classroom}}', [
            'id' => $this->primaryKey()->unsigned(),
            'school_id' => $this->integer()->unsigned()->notNull(),
            'class' => $this->integer()->notNull(),
            'section_class' => $this->char()->notNull(),
            'course_id' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_bsw_classroom_bsw_school1_idx', '{{%classroom}}', 'school_id');
        $this->createIndex('fk_class_course1_idx', '{{%classroom}}', 'course_id');
        $this->createIndex('ID_classe_UNIQUE', '{{%classroom}}', 'id', true);
        $this->addForeignKey('fk_classroom_course1', '{{%classroom}}', 'course_id', '{{%course}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_classroom_school1', '{{%classroom}}', 'school_id', '{{%school}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%classroom}}');
    }
}
