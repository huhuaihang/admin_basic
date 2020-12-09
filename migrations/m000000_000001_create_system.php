<?php

use yii\db\Migration;

class m000001_0000001_create_system extends Migration
{
	public function safeUp()
	{
		$this->createTable('system', [
			'id' => $this->primaryKey(), // PK ID
			'category' => $this->string(32), // 类别
			'show_name' => $this->string(32), // 说明
			'name' => $this->string(128), // 名称
			'type' => $this->string(512), // 类型
			'value' => $this->text(), // 值
		]);
		this->batchInsert('{{%system}}', ['category', 'show_name', 'name', 'type', 'value'], [
            ['系统设置', '系统版本', 'system_version', json_encode(['type'=>'text', 'disabled'=>true]), '1.0.0'],
            ['网站设置', '名称', 'site_name', json_encode(['type' => 'text']), ''],
            ['网站设置', 'LOGO', 'site_logo', json_encode(['type' => 'file']), ''],
            ['网站设置', '首页标题', 'site_index_title', json_encode(['type' => 'text']), ''],
            ['网站设置', '首页描述', 'site_index_desc', json_encode(['type' => 'text']), ''],
            ['网站设置', '首页关键字', 'site_index_keywords', json_encode(['type' => 'text']), ''],
            ['网站设置', '许可证', 'site_license', json_encode(['type' => 'text']), ''],
            ['网站设置', '联系客服页面', 'site_contact', json_encode(['type' => 'richtext']), '']
        ]);
	}

	public function down()
    {
        $this->dropTable('{{%system}}');
    }
}