<?php

use yii\db\Migration;

/**
 * Class m241012_134849_add_volume_to_box_table
 */
class m241012_134849_add_volume_to_box_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241012_134849_add_volume_to_box_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241012_134849_add_volume_to_box_table cannot be reverted.\n";

        return false;
    }
    */
}
