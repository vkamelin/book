<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author_book}}`.
 */
class m240821_110422_create_book_author_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author_book}}', [
            'id' => $this->primaryKey()->unsigned(),
            'book_id' => $this->integer()->notNull(),
            'book_author_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-book_author_book-book_id}}',
            '{{%book_author_book}}',
            'book_id'
        );

        $this->addForeignKey(
            '{{%fk-book_author_book-book_id}}',
            '{{%book_author_book}}',
            'book_id',
            '{{%book}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-book_author_book-book_author_id}}',
            '{{%book_author_book}}',
            'book_author_id'
        );

        $this->addForeignKey(
            '{{%fk-book_author_book-book_author_id}}',
            '{{%book_author_book}}',
            'book_author_id',
            '{{%book_author}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-book_author_book-book_id}}', '{{%book_author_book}}');
        $this->dropForeignKey('{{%fk-book_author_book-book_author_id}}', '{{%book_author_book}}');
        $this->dropIndex('{{%idx-book_author_book-book_id}}', '{{%book_author_book}}');
        $this->dropIndex('{{%idx-book_author_book-book_author_id}}', '{{%book_author_book}}');
        $this->dropTable('{{%book_author_book}}');
    }
}
