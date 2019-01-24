<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_condition extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%condition}}', [
            'id' => $this->tinyInteger()->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'condition' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%condition}}');
    }
}
