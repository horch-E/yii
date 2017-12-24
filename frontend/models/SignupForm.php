<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $mobile;
    public $password;
    public $password1;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 20],

            ['mobile', 'trim'],
            ['mobile', 'required'],
            ['mobile','validatePhone'],
            //['mobile', 'email'],
            ['mobile', 'string', 'max' => 11],
            ['mobile', 'unique', 'targetClass' => '\common\models\User', 'message' => '该手机号已注册,请尝试找回密码'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password1', 'required'],
            ['password1', 'string', 'min' => 6],
            ['password1','validatePassword'],
            ['verifyCode','captcha']
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
    * 验证重复密码是否一致
    */
    public function validatePassword($attribute,$params)
    {
        if (!$this->hasErrors()){
            if($this->password != $this->password1){
                $this->addError($attribute,'确认密码不一致！');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'mobile' => '手机号码',
            'password' => '密码',
            'password1' => '确认密码',
            'verifyCode' => '验证码'
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->mobile = $this->mobile;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
