<?php
class UserModel
{
    public function login($username = '', $password = '')
    {
        if ($username != 'lxf') {
            // 用户不存在
            throw new Exception('用户不存在', '404');
        }
        if ($password != '123456') {
            // 密码错误
            throw new Exception('密码错误', '400');
        }
    }
}

class UserController
{
    public function login($username = '', $password = '')
    {
        what();
        try {

            //$model = new UserModel();
            //$res   = $model->login($username, $password);
            // 如果需要的话，我们可以在这里统一commit数据库事务
            // $db->commit();
        } catch (Exception $e) {
            // 如果需要的话，我们可以在这里统一rollback数据库事务
            // $db->rollback();
            return [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }
}
