<?php

use yii\db\Migration;

/**
 * Class m210202_134640_tasks
 */
class m210202_134640_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'content' => $this->text(),
            'priority' => $this->integer()->notNull()->defaultValue(1),
            'performer_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'viewed' => $this->boolean()->defaultValue(false)
        ]);

        $this->createIndex(
            'idx-post-performer_id',
            'tasks',
            'performer_id'
        );

        $this->addForeignKey(
            'fk-post-performer_id',
            'tasks',
            'performer_id',
            'user',
            'id',
            'NO ACTION'
        );

        $this->createIndex(
            'idx-post-author_id',
            'tasks',
            'author_id'
        );

        $this->addForeignKey(
            'fk-post-author_id',
            'tasks',
            'author_id',
            'user',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-performer_id',
            'tasks'
        );

        $this->dropIndex(
            'idx-post-performer_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-post-author_id',
            'tasks'
        );

        $this->dropIndex(
            'idx-post-author_id',
            'tasks'
        );

        $this->dropTable('post');
    }
}
