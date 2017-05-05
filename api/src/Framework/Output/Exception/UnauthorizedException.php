<?php

namespace SignupFormTest\Framework\Output\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;
use Symfony\Component\Routing\Exception\InvalidArgumentException;

class UnauthorizedException extends \InvalidArgumentException implements ExceptionInterface
{
}
