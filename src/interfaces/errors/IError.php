<?php
namespace extas\interfaces\errors;

use extas\interfaces\IHasType;
use extas\interfaces\samples\ISample;

/**
 * Interface IError
 *
 * @package extas\interfaces\errors
 * @author jeyroik@gmail.com
 */
interface IError extends ISample, IHasType
{
    public const TYPE__INFO = 'info';
    public const TYPE__NOTICE = 'notice';
    public const TYPE__ERROR = 'error';
    public const TYPE__FATAL = 'fatal';

    public const FIELD__CODE = 'code';

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @param int $code
     * @return $this
     */
    public function setCode(int $code);
}
