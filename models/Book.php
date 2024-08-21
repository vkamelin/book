<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property string $isbn
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'year', 'isbn', 'description'], 'required'],
            [['year', 'created_at', 'updated_at'], 'integer'],
            ['isbn', 'unique'],
            ['name', 'string', 'max' => 250],
            ['isbn', 'string', 'max' => 13],
            ['isbn', 'description', 'max' => 65535],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'year' => 'Нод выпуска',
            'isbn' => 'ISBN',
            'description' => 'Описание',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    'value' => new Expression('NOW()'),
                ],
            ],
        ];
    }
}
