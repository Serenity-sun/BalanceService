<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transactions}}`.
 */
class m230623_025804_create_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%transactions}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'balance' => $this->integer()->notNull(),
            'description' => $this->string(),
            'currency' => $this->string(3)->notNull(),
            'type' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%transactions}}');
    }
}
