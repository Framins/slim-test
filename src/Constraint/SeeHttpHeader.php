<?php

namespace MilesChou\Slim\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class SeeHttpHeader extends Constraint
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $name HTTP header name
     * @param string $value HTTP header value
     */
    public function __construct($name, $value)
    {
        parent::__construct();

        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other)
    {
        if ($this->value === null) {
            return isset($other[$this->name]);
        } else {
            return isset($other[$this->name]) && in_array($this->value, $other[$this->name]);
        }
    }

    /**
     * @return string
     */
    public function toString()
    {
        if ($this->value === null) {
            return "contains '{$this->name}' header name";
        } else {
            return "contains '{$this->name}' header name and contains '{$this->value}' value";
        }
    }
}
