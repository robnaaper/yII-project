<?php

use yii\db\Migration;

/**
 * Class m241012_134340_add_volume_to_box_table
 */
class m241012_134340_add_volume_to_box_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('box', 'volume', $this->decimal(10, 2)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('box', 'volume');
    }

}
