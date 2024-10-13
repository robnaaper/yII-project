<?php

use yii\db\Migration;

/**
 * Class m241012_091458_first_migration
 */
class m241012_091458_first_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание таблицы коробок
        $this->createTable('boxes', [
            'id' => $this->primaryKey(),
            'width' => $this->decimal(10, 2)->notNull(),
            'height' => $this->decimal(10, 2)->notNull(),
            'length' => $this->decimal(10, 2)->notNull(),
            'weight' => $this->decimal(10, 2)->notNull(),
            'reference' => $this->string()->notNull(),
            'status' => $this->string()->notNull()->defaultValue('Expected'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Создание таблицы карточек товаров
        $this->createTable('box_card', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'sku' => $this->string()->notNull()->unique(),
            'shipped_qty' => $this->integer()->notNull(),
            'received_qty' => $this->integer(),
            'price' => $this->decimal(10, 2),
            'box_id' => $this->integer()->notNull(), //
            'FOREIGN KEY (box_id) REFERENCES boxes(id) ON DELETE CASCADE',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Сначала удаляем таблицу карточек товаров
        $this->dropTable('box_card');
        // Затем удаляем таблицу коробок
        $this->dropTable('boxes');
    }
}

