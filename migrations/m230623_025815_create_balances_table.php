<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%balances}}`.
 */
class m230623_025815_create_balances_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%balances}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'balance' => $this->integer()->notNull(),
            'currency' => $this->string(3)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%balances}}');
    }
}
