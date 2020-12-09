<?php

use app\models\Manager;
use app\models\Util;
use yii\db\Migration;

class m000001_000002_create_manager extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%manager}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(256), // 用户名
            'auth_key' => $this->string(32),
            'password' => $this->string(256), // HASH密码
            'nickname' => $this->string(256), // 昵称
            'mobile' => $this->string(32), // 手机号码
            'email' => $this->string(256), // 电子邮箱
            'rid' => $this->integer(), // 角色编号
            'status' => $this->integer(), // 状态
            'create_time' => $this->integer(), // 创建时间
        ]);
        $this->createIndex('fk_manager_manager_role1_idx', '{{%manager}}', ['rid']);
        try {
            $this->addForeignKey('fk_manager_manager_role1', '{{%manager}}', ['rid'], '{{%manager_role}}', ['id']);
        } catch (Exception $e) {
            Yii::error($e->getMessage());
        }
        $this->batchInsert('{{%key_map}}', ['t', 'k', 'v'], [
            ['manager_status', 1, '正常'],
            ['manager_status', 9, '停止'],
            ['manager_status', 0, '删除'],
        ]);
        $this->insert('{{%manager}}', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => Util::randomStr(32, 7),
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'nickname' => '系统管理员',
            'mobile' => '00000000000',
            'email' => '***@qq.com',
            'rid' => 1, // manager_role.id
            'status' => 1,
            'create_time' => time(),
        ]);
    }

    public function down()
    {
        $this->delete('{{%key_map}}', ['t' => 'manager_status']);
        $this->dropTable('{{%manager}}');
    }
}
