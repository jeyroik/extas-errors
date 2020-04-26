<?php
namespace extas\components\errors;

use extas\components\samples\Sample;
use extas\components\THasType;
use extas\interfaces\errors\IError;

/**
 * Class Error
 *
 * @package extas\components\errors
 * @author jeyroik@gmail.com
 */
class Error extends Sample implements IError
{
    use THasType;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getTitle() . ': ' . $this->getDescription();
    }

    /**
     * @return int
     */
    public function __toInt(): int
    {
        return $this->getCode();
    }

    /**
     * @return string
     */
    public function __toJson(): string
    {
        return json_encode([
            'code' => $this->getCode(),
            'message' => $this->__toString(),
            'data' => $this->getParametersValues()
        ]);
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->config[static::FIELD__CODE] ?? 0;
    }

    /**
     * @param int $code
     * @return $this|Error
     */
    public function setCode(int $code)
    {
        $this->config[static::FIELD__CODE] = $code;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.error';
    }
}
