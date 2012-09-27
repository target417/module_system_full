<?php
/**
 * Отрисовывает группы пользователя в соответствии со стилем.
 */
class WUserGroup extends Widget
{
    /**
     * Название группы.
     * @var string
     */
    public $group;

    /**
     * CSS-стиль группы.
     * @var string
     */
    public $style = null;

    /**
     * @see CWidget::run()
     */
    public function run()
    {
        if($this->style !== null)
            $str = '<span class="user-group" style="' . $this->style . '">';
        else
            $str = '<span class="user-group">';

        $str .= $this->group;

        $str .= '</span>';

        echo $str;
    }
}