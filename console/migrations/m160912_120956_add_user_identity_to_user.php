<?php

use yii\db\Migration;
use yii\db\Schema;

class m160912_120956_add_user_identity_to_user extends Migration
{
    public function up()
    {
		$this->addColumn('{{%user}}', 'user_identity', Schema::TYPE_STRING);
    }

    public function down()
    {
       $this->dropColumn('{{%user}}', 'user_identity');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
