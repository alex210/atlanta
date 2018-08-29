<?php

use yii\db\Migration;

/**
 * Class m180826_195007_authors
 */
class m180826_195007_authors extends Migration
{
    public function up()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'surname' => $this->string(255),
        ], $tableOptions); 
    }

    public function down()
    {
        $this->dropTable('{{%authors}}');
        return true;
    }
}
