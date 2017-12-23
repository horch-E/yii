<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $mobile;
    public $password;
    public $rememberMe = true;
    public $verifyCode;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['mobile', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['mobile', 'trim'],
            ['mobile', 'string', 'max' => 11],
            ['mobile','validatePhone'],
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['verifyCode','captcha'],
        ];
    }


    /**
     * 验证手机号码是否符合规则
     */
    public function validatePhone($attribute,$params)
    {
        if (!$this->hasErrors()){
            $len = strlen($this->mobile);
            $pattern = "/0?(13|14|15|18)[0-9]{9}/";
            $result =preg_match($pattern,$this->mobile);
            if ($len != 11 || !$result)
            {
                $this->addError($attribute,'手机号码格式错误！');
            } 
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
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
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByMobile($this->mobile);
        }

        return $this->_user;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mobile' => '手机号码',
            'password' => '密码',
            'rememberMe' => '记住我',
            'verifyCode' => '验证码',

        ];
    }

}
