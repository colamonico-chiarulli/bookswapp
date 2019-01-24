<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_gender extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gender}}', [
            'id' => $this->smallInteger()->unsigned()->notNull()->append('PRIMARY KEY'),
            'gender_name' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%gender}}');
    }
}
