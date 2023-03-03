<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property int    $id
 * @property string $name       Имя
 * @property string $email      Email
 * @property string $phone      Телефон
 * @property string $region     Регион
 * @property string $city       Город
 * @property int    $gender     Пол
 * @property string $question   Вопрос
 * @property int    $rating     Оценка
 * @property string $comment    Комментарий
 * @property string $created_at Дата заполнения
 */
class Profiles extends \yii\db\ActiveRecord
{
    public const GENDER_MALE = 1;
    public const GENDER_FEMALE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['name', 'email', 'phone', 'region', 'city', 'gender', 'question', 'rating', 'comment'],
                'required',
            ],
            [['gender', 'rating'], 'integer'],
            ['created_at', 'safe'],
            ['email', 'email'],
            [['name', 'email', 'phone', 'region', 'city', 'question', 'comment'], 'string', 'max' => 255],
            ['gender', 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE]],
            ['rating', 'compare', 'compareValue' => 10, 'operator' => '<=', 'type' => 'integer'],
            ['rating', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'region' => 'Регион',
            'city' => 'Город',
            'gender' => 'Пол',
            'question' => 'Вопрос',
            'rating' => 'Оценка',
            'comment' => 'Комментарий',
            'created_at' => 'Дата заполнения',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function getGenders()
    {
        return [
            self::GENDER_MALE => 'Мужской',
            self::GENDER_FEMALE => 'Женский',
        ];
    }
}
