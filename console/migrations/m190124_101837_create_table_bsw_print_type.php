<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_print_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%print_type}}', [
            'id' => $this->tinyInteger()->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'print_type' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('print_type_UNIQUE', '{{%print_type}}', 'print_type', true);
    }

    public function down()
    {
        $this->dropTable('{{%print_type}}');
    }
}
