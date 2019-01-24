<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_school extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name_school' => $this->string()->notNull(),
            'code_school' => $this->string(),
            'order_school' => $this->string(),
            'zip_school' => $this->string(),
            'city_school' => $this->string()->notNull(),
            'district_school' => $this->string(),
            'address_school' => $this->string()->notNull(),
            'phone1_school' => $this->string(),
            'fax_school' => $this->string(),
            'phone2_school' => $this->string(),
            'email1_school' => $this->string(),
            'email2_school' => $this->string(),
            'url_school' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('code_school_UNIQUE', '{{%school}}', 'code_school', true);
    }

    public function down()
    {
        $this->dropTable('{{%school}}');
    }
}
