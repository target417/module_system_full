<?php
/*
 * Входной контроллер модуля.
 */
class IndexController extends BackController
{
    /**
     * Главная страница модуля.
     * @param string $group Группа пользователей
     * @param string $searchString Строка дял поиска логина
     * @return void
     */
    public function actionIndex($group = null, $searchString = null)
    {
        // Загрузка списка групп.
        $groupsList = $this->loadGroupsList();

        // Загрузка списка пользователей.
        if(!empty($group))
            $param['group'] = (int)$group;

        if(!empty($searchString))
            $param['searchString'] = $searchString;

        $usersList = $this->loadUsersList($param);
        // -----<<
        
        $this->render('index', array(
            'usersList' => $usersList,
            'groupsList' => $groupsList,
        ));

    }

    /**
     * загрузка списка групп из БД.
     * @return array
     */
    protected function loadGroupsList()
    {
        $return = Yii::app()->db->createCommand("
            SELECT
                t.group,
                t.id
            FROM
                user_group AS t
            ORDER BY
                t.group
        ")->queryAll();

        return $return;
    }

    /**
     * Загрузка списка пользователей из БД.
     * @param array $param Значения параметров дя поиска
     * @return array Массив с сущностями пользователей
     */
    protected function loadUsersList($param = null)
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

        // Добавляем переданные пользователей условия выборки.
        if(!empty($param)) {
            $sqlConditions = array('and');

            // Группа пользователя.
            if(isset($param['group'])) {
                $sqlConditions[] = 'rGroup.id = :group';
                $sqlParams[':group'] = $param['group'];
            }

            // Поиск по логину.
            if(isset($param['searchString'])) {
                $sqlConditions[] = 't.login LIKE :search';
                $sqlParams[':search'] = '%' . $param['searchString'] . '%';
            }

            $sql->where($sqlConditions, $sqlParams);
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
