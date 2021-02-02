<?php

use yii\db\Migration;

/**
 * Class m210202_140042_create_fk_to_status
 */
class m210202_140042_create_fk_to_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-post-status_id',
            'tasks',
            'status_id'
        );

        $this->addForeignKey(
            'fk-post-status_id',
            'tasks',
            'status_id',
            'status',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-status_id',
            'tasks'
        );

        $this->dropIndex(
            'idx-post-status_id',
            'tasks'
        );
    }
}
