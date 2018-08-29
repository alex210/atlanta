<?php

use yii\db\Migration;

/**
 * Class m180826_195904_journals
 */
class m180826_195904_journals extends Migration
{
    public function up()
    {
        $this->createTable('{{%journals}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->string(255),
            'img' => $this->string(255),
            'created_at' => $this->date(),
        ], $tableOptions);

        $this->createTable('{{%journal_has_authors}}', [
            'id' => $this->primaryKey(),
            'journal_id' => $this->integer(),
            'author_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_journal_has_authors_journal', '{{%journal_has_authors}}', 'journal_id', '{{%journals}}', 'id', 'CASCADE'
        );

        $this->addForeignKey(
            'FK_journal_has_authors_author', '{{%journal_has_authors}}', 'author_id', '{{%authors}}', 'id', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%journals}}');
        $this->dropTable('{{%journal_has_authors}}');
        return true;
    }
}
