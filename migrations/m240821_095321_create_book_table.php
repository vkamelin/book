<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m240821_095321_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(250)->notNull(),
            'year' => $this->smallInteger(4)->notNull(),
            'isbn' => $this->string(13)->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
