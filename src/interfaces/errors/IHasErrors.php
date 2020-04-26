<?php
namespace extas\interfaces\errors;

/**
 * Interface IHasErrors
 *
 * @package extas\interfaces\errors
 * @author jeyroik@gmail.com
 */
interface IHasErrors
{
    public const FIELD__ERRORS = 'errors';

    /**
     * @return IError[]
     */
    public function getErrors(): array;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @param IError[] $errors
     * @return $this
     */
    public function setErrors(array $errors);

    /**
     * @param IError $error
     * @return $this
     */
    public function addError(IError $error);
}
