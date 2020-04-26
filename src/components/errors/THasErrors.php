<?php
namespace extas\components\errors;

use extas\interfaces\errors\IError;
use extas\interfaces\errors\IHasErrors;

/**
 * Trait THasErrors
 *
 * @property array $config
 *
 * @package extas\components\errors
 * @author jeyroik@gmail.com
 */
trait THasErrors
{
    /**
     * @return IError[]
     */
    public function getErrors(): array
    {
        return $this->config[IHasErrors::FIELD__ERRORS] ?? [];
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->config[IHasErrors::FIELD__ERRORS]);
    }

    /**
     * @param IError[] $errors
     * @return $this
     */
    public function setErrors(array $errors)
    {
        $this->config[IHasErrors::FIELD__ERRORS] = $errors;

        return $this;
    }

    /**
     * @param IError $error
     * @return $this
     */
    public function addError(IError $error)
    {
        $errors = $this->getErrors();
        $errors[] = $error;
        $this->setErrors($errors);

        return $this;
    }
}
