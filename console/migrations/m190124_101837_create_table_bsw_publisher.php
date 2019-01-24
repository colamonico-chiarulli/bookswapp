<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_publisher extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%publisher}}', [
            'id' => $this->primaryKey()->unsigned(),
            'publisher' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('publisher_UNIQUE', '{{%publisher}}', 'publisher', true);
    }

    public function down()
    {
        $this->dropTable('{{%publisher}}');
    }
}
