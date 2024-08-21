<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read \yii\web\IdentityInterface|null $user
 */
class LoginForm extends Model
{
    public string $username;
    public string $password;
    public bool $rememberMe = true;

    private bool|User $_user = false;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     * @return array the validation rules.
     */
    public function validatePassword(string $attribute, array $params): array
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return bool|User|null
     */
    protected function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
