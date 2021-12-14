<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

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
     * @param int|null $id
     * @param string $value
     * @param bool $status
     */
    public function __construct(
        int    $id = null,
        string $value = '',
        bool   $status = false
    ) {
        $this->id = $id;
        $this->value = $value;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
}
