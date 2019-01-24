<?php

use yii\db\Migration;

class m190124_101838_create_table_bsw_user_status extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_status}}', [
            'id' => $this->smallInteger()->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'status_name' => $this->string()->notNull(),
            'status_value' => $this->smallInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%user_status}}');
    }
}
