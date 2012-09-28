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


        if($this->id !== null) {
            $str = '<span class="user-login">';

            switch($this->linkType) {
                case 'link' :
                    $str .= '<a href="'
                    . Yii::app()->createUrl('user/index/profile', array('id' => $this->id))
                    . '"';

                    if($this->style !== null)
                        $str .= ' style="' . $this->style . '"';

                    $str .= '>';
                    break;
            }
        } else {
            if($this->style !== null)
                $str = '<span class="user-login">';
            else
                $str = '<span class="user-login">';
        }

        $str .= $this->login;

        if($this->id !== null)
            $str .= '</a>';

        $str .= '</span>';

        echo $str;
    }
}