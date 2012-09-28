<?php
/**
 * Отрисовывает логин пользователя в соответствии со стилем группы.
 * Возможно отображение в виде ссылки на профиль.
 */
class WUserLogin extends Widget
{
    /**
     * Логин пользователя.
     * @var string
     */
    public $login;

    /**
     * Id пользователя.
     * @var int
     */
    public $id = null;

    /**
     * Тип ссылки на профиль.
     * - "link" - Полная ссылка
     * - "ajax" - Всплывающее окно
     * @var string
     */
    public $linkType = 'link';

    /**
     * @see CWidget::run()
     */
    public function run()
    {
        if(!empty($this->id)) {
            switch($this->linkType) {
                case 'link' :
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('user/index/profile', array('id'=>$thid->id));?>" class="user-login">
                        <?php echo $this->login; ?>
                    </a>
                    <?php
            }
        } else {
            ?><span class="user-login"><?php echo $this->login; ?></span><?php
        }

        echo $str;
    }
}