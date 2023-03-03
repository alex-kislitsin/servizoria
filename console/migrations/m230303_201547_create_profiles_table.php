<?php

use common\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%profiles}}`.
 */
class m230303_201547_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'root',
            'email' => 'webmaster@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('rootroot'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Имя'),
            'email' => $this->string()->notNull()->comment('Email'),
            'phone' => $this->string()->notNull()->comment('Телефон'),
            'region' => $this->string()->notNull()->comment('Регион'),
            'city' => $this->string()->notNull()->comment('Город'),
            'gender' => $this->smallInteger()->notNull()->comment('Пол'),
            'question' => $this->string()->notNull()->comment('Вопрос'),
            'rating' => $this->tinyInteger()->notNull()->comment('Оценка'),
            'comment' => $this->string()->notNull()->comment('Комментарий'),
            'created_at' => $this->dateTime()->notNull()->comment('Дата заполнения'),
        ]);

        $this->createIndex('idx_profiles_created_at','profiles','created_at');
        $this->createIndex('idx_profiles_gender','profiles','gender');
        $this->createIndex('idx_profiles_region','profiles','region');
        $this->createIndex('idx_profiles_city','profiles','city');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
