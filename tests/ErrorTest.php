<?php
namespace tests;

use Dotenv\Dotenv;
use extas\components\errors\Error;
use extas\components\errors\THasErrors;
use extas\components\Item;
use extas\interfaces\errors\IError;
use extas\interfaces\errors\IHasErrors;
use PHPUnit\Framework\TestCase;

/**
 * Class ErrorTest
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class ErrorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testHasErrors()
    {
        $hasErrors = new class extends Item implements IHasErrors {
            use THasErrors;

            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $this->assertFalse($hasErrors->hasErrors());
        $hasErrors->addError(new Error([
            Error::FIELD__CODE => 400,
            Error::FIELD__NAME => 'not_found',
            Error::FIELD__TITLE => 'Not found',
            Error::FIELD__DESCRIPTION => 'Entity not found'
        ]));
        $this->assertTrue($hasErrors->hasErrors());

        $errors = $hasErrors->getErrors();
        foreach ($errors as $error) {
            $this->assertTrue($error instanceof IError);
            $this->assertEquals(400, $error->__toInt());
            $this->assertEquals(
                $error->getTitle() . ': ' . $error->getDescription(),
                (string) $error
            );
            $this->assertEquals(
                json_encode([
                    'code' => $error->getCode(),
                    'message' => $error->__toString(),
                    'data' => $error->getParametersValues()
                ]),
                $error->__toJson()
            );
            $error->setCode(500);
            $this->assertEquals(500, $error->getCode());
        }
    }
}
