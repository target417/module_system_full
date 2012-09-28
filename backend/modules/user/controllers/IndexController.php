<?php
/*
 * Входной контроллер модуля.
 */
class IndexController extends BackController
{
    /**
     * Главная страница модуля.
     * @param string $group Группа пользователей
     * @return void
     */
    public function actionIndex($group = null)
    {
        // Загрузка списка пользователей.
        if(!empty($group)) {
            $usersList = $this->loadUsersList('group', (int)$group);
        } else {
            $usersList = $this->loadUsersList();
        }

        $this->render('index', array(
            'usersList' => $usersList,
            'groupsList' => $groupsList,
        ));

    }

    /**
     * Загрузка списка пользователей из БД.
     * @param string $param Параметр, по которому осуществляется поиск
     * @param mixed $value Значение этого параметра
     * @return array Массив с сущностями пользователей
     */
    protected function loadUsersList($param = null, $value = null)
    {
        $sql = Yii::app()->db->createCommand()
            ->select(array(
                't.id',
                't.login',
                't.is_confirm AS isConfirm',
                'rFull.date_reg AS dateReg',
                'rGroup.group AS groupName',
                'rGroup.style AS groupStyle',
                'rLastOnline.last_online AS lastOnline',
            ))
            ->from(array(
                'user AS t',
            ))
            ->leftJoin('user_full AS rFull', 'rFull.id = t.id')
            ->leftJoin('user_group AS rGroup', 'rGroup.id = t.group')
            ->leftJoin('user_last_online AS rLastOnline', 'rLastOnline.user = t.id')
            ->order('t.login');

        switch($param) {
            case 'group' :
                $sqlConditions = 'rGroup.id = :group';
                $sqlParams = array(
                    ':group' => $value,
                );

                $sql->where($sqlConditions, $sqlParams);
                break;

            default :
                break;
        }

        $result = $sql->queryAll();

        // Формируем сущности.
        while($item = each($result)) {
            $user = new EUser();
            $user->attributes = $item[1];

            $return[] = $user;
        }

        return $return;
    }

    /**
     * @see Conctroller::createPageParams()
     */
    protected function createPageParams()
    {
        switch($this->action->id) {
            case 'index' :
                if(!Yii::app()->user->checkAccess('user_access_cms'))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;
        }
    }
}
