<?php

use yii\db\Migration;

class m190124_101838_create_table_bsw_user_profile extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'birthdate' => $this->date(),
            'gender_id' => $this->smallInteger()->unsigned()->notNull(),
            'zip_user' => $this->string(),
            'city_user' => $this->string()->notNull(),
            'district_user' => $this->string()->notNull(),
            'address_user' => $this->string()->notNull(),
            'phone1_user' => $this->string()->notNull(),
            'phone2_user' => $this->string(),
            'geo_lat_user' => $this->decimal()->comment('User geographic coordinates latitude'),
            'geo_lng_user' => $this->decimal()->comment('User geographic coordinates longitude'),
            'school_verificated_user' => $this->tinyInteger()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_bsw_user_profile_1_idx', '{{%user_profile}}', 'user_id');
        $this->createIndex('fk_bsw_user_profile_bsw_gender1_idx', '{{%user_profile}}', 'gender_id');
        $this->addForeignKey('profile2user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_bsw_user_profile_bsw_gender1', '{{%user_profile}}', 'gender_id', '{{%gender}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%user_profile}}');
    }
}
