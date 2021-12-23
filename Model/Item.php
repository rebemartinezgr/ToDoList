<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Source/Category.php";

/**
 * Item Model Class
 */
class Item
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var int
     */
    private $category;
    /**
     * @var string
     */
    private $date;

    /**
     * @param int|null $id
     * @param string $value
     * @param bool $status
     * @param string $category
     * @param string $date
     */
    public function __construct(
        int    $id = null,
        string $value = '',
        bool   $status = false,
        string $category = '',
        string $date = ''
    ) {
        $this->id = $id;
        $this->value = $value;
        $this->status = $status;
        $this->category = $category;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id ?? 0;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return ucfirst(trim($this->value));
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = trim($value);
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategoryLabel(): string
    {
        $categorySource = new Category();

        return $categorySource->getOptionLabel($this->category);
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function validateDate(): bool
    {
        $year = date("Y", strtotime($this->getDate()));
        $month = date("m", strtotime($this->getDate()));
        $day = date("d", strtotime($this->getDate()));

        return checkdate($month, $day, $year);
    }

    /**
     * @return bool
     */
    public function validateCategory(): bool
    {
        return $this->getCategoryLabel() ?? false;
    }
}
