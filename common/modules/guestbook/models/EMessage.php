<?php
/**
 * Сообщение гостевой книги (сущность).
 */
class EMessage extends Essence
{
    /**
     * Id.
     * @var int
     */
    public $id;

    /**
     * Автор.
     * @var string
     */
    public $author;

    /**
     * Текст сообщения.
     * @var string
     */
    public $text;

    /**
     * Текст ответа.
     * @var string
     */
    public $answer = null;

    /**
     * Дата добавления.
     * @var string
     */
    public $dateCreate = null;

    /**
     * Возвращает id сообщения.
     * @return void
     */
    public function getId()
    {
        echo $this->id;
    }

    /**
     * Возвращает автора сообщения.
     * @return void
     */
    public function getAuthor()
    {
        echo $this->author;
    }

    /**
     * Возвращает текст сообщения.
     * @return void
     */
    public function getText()
    {
        echo $this->text;
    }

    /**
     * Возвращает ответ на сообщение.
     * @return void
     */
    public function getAnswer()
    {
        if(!empty($this->answer))
            echo $this->answer;
    }

    /**
     * возвращает дату добавления сообщения.
     * @return void
     */
    public function getDatecreate()
    {
        if(!empty($this->datecreate))
            echo LDateTime::formatDate($this->dateCreate, true);
    }

    /**
     * @see Essence::__construct()
     */
    public function __construct($class = __CLASS__)
    {
        parent::__construct($class);
    }
}