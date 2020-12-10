<?php

use yii\db\Migration;

class m000001_000004_create_permission extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%permission}}', [
        	'id' => $this->primaryKey(), // PK
        	'name' => $this->string(20), // 权限名称
        	'pid' => $this->integer(), // 父级ID
        	'controller' => $this->string(32), // 控制器
        	'action' => $this->string(32), // 操作方法
        	'level' => $this->integer(), // 等级
        ])
        $this->createIndex('fk_permission_permission1_idx', '{{%permission}}', ['pid']);
        try {
            $this->addForeignKey('fk_permission_permission1', '{{%permission}}', ['pid'], '{{%permission}}', ['id']);
        } catch (Exception $e) {
            Yii::error($e->getMessage());
        }
    }

	public function down()
    {
        $this->dropTable('{{%permission}}');
    }
}