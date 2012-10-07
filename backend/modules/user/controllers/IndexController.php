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
            'usersList' => $usersList[0],
            'pages' => $usersList[1],
            'groupsList' => $groupsList,
        ));

    }

    /**
     * Редактирование профиля пользователя.
     * @param int $id Id редактируемог пользователя
     * @return void
     */
    public function actionEditProfile($id)
    {
        $id = (int)$id;

        if(!$user = MUser::model()->findByPk($id))
            throw new CHttpException(404, self::EXC_WRONG_ADDRESS);

        $user->scenario = 'adminProfile';

        if(isset($_POST['MUser'])) {
            if(Yii::app()->user->checkAccess('user_admin_profile_login'))
                $user->login = $_POST['MUser']['login'];
            if(Yii::app()->user->checkAccess('user_admin_profile_group'))
                $user->group = $_POST['MUser']['group'];
            if(Yii::app()->user->checkAccess('user_admin_profile_confirm'))
                $user->is_confirm = $_POST['MUser']['is_confirm'];

            if($user->save())
                $this->redirect(Yii::app()->createUrl('user/index/index'));
        }

        $this->render('editProfile', array(
            'user' => $user,
        ));
    }

    /**
     * Удаление пользователя.
     * @param int $id Id удаляемог опользователя.
     * @return void
     */
    public function actionRemoveUser($id)
    {
        $id = (int)$id;

        $result = Yii::app()->db->createCommand("
            SELECT
                t.login
            FROM
                user AS t
            WHERE
                t.id = {$id}
        ")->queryRow();

        if(empty($result))
            throw new CHttpException(404, self::EXC_WRONG_ADDRESS);

        $user = new EUser();
        $user->attributes = $result;

        if(!empty($_POST)) {
            Yii::app()->db->createCommand("
                UPDATE
                    user
                SET
                    is_remove = 1
                WHERE
                    id = {$id}
            ")->execute();

            $this->redirect(Yii::app()->createUrl('user/index/index'));
        }

        $this->render('removeUser', array(
            'user' => $user,
        ));
    }

    /**
     * Загрузка списка групп из БД.
     * @return array
     */
    protected function loadGroupsList()
    {
        $return = Yii::app()->db->createCommand("
            SELECT
                t.group,
                t.id,
                count(rUser.id) AS countUsers
            FROM
                user_group AS t
            LEFT JOIN
                user AS rUser ON(t.id = rUser.group)
            GROUP BY
                t.group
            ORDER BY
                t.group
        ")->queryAll();

        return $return;
    }

    /**
     * Загрузка списка пользователей из БД.
     * @param array $param Значения параметров дя поиска
     * @return array
     * 0 => Массив с сущностями пользователей
     * 1 => Экземпляр сдасса Pagination
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

        // Разделяем на страницы.
        $countSql = clone $sql;
        $count = $countSql->select('COUNT(t.id)')->queryScalar();
        $pages = new Pagination($count);
        $pages->pageSize = $this->module->getParams()->usersOnPage;
        $sql->limit($pages->pageSize, $pages->currentPage * $pages->pageSize);

        $result = $sql->queryAll();

        // Формируем сущности.
        while($item = each($result)) {
            $user = new EUser();
            $user->attributes = $item[1];
            $return[] = $user;
        }

        return array($return, $pages);
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

            case 'editProfile' :
                if(!Yii::app()->user->checkAccess('user_admin_profile'))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;

            case 'removeUser' :
                if(!Yii::app()->user->checkAccess('user_admin_profile_remove', array('id' => (int)$_GET['id'])))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;
        }
    }
}
