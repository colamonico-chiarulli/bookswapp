<?php

use yii\db\Migration;

class m190124_101838_create_table_bsw_user_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_type}}', [
            'id' => $this->smallInteger()->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'user_type_name' => $this->string()->notNull(),
            'user_type_value' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%user_type}}');
    }
}
