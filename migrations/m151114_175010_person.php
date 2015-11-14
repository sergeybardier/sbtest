<?php

use yii\db\Schema;
use yii\db\Migration;

class m151114_175010_person extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%person}}',[
            'id'=>$this->primaryKey(),
            'firstname'=>$this->string(32)->notNull(),
            'lastname'=>$this->string(32)->notNull(),
            'birth_date'=>$this->date()->notNull(),
            'zip_code'=>$this->string(16)->notNull(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%person}}');
    }
}
