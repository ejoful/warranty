<?php

use yii\db\Migration;
use yii\db\Schema;

class m160920_043521_add_userIdentity_to_tbl_user extends Migration
{
    public function up()
    {
		$this->addColumn('{{%user}}', 'userIdentity', Schema::TYPE_STRING. "(50) NOT NULL");
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'userIdentity');
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
