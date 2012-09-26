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
     * CSS-стиль группы.
     * @var string
     */
    public $style = null;

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
        if($this->style !== null)
            $str = '<span class="user-login" style="' . $this->style . '">';
        else
            $str = '<span class="user-login">';

        if($this->id !== null) {
            switch($this->linkType) {
                case 'link' :
                    $str .= '<a href="'
                    . Yii::app()->createUrl('user/index/profile', array('id' => $this->id))
                    . '">';

                    break;
            }
        }

        $str .= $this->login;

        if($this->id !== null)
            $str .= '</a>';

        $str .= '</span>';

        echo $str;
    }
}