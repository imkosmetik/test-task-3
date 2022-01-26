<?php

use yii\db\Migration;

/**
 * Class m220125_114522_create_items_and_groups_tables
 */
class m220125_114522_create_items_and_groups_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull()->comment('ID категории'),
            'name' => $this->string()->notNull()->comment('Название'),
            'marking' => $this->string()->notNull()->comment('Артикул'),
            'rating' => $this->float(2)->null()->comment('Рейтинг'),
        ], $tableOptions);

        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull()->comment('ID родительской категории'),
            'name' => $this->string()->notNull()->comment('Название'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
        $this->dropTable('{{%group}}');
    }
}
