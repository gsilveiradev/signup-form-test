<?php

namespace SignupFormTest\Framework\Output;

use Symfony\Component\HttpFoundation\Response;
use SignupFormTest\Framework\Output\OutputFormatter;

class OutputResponse
{
    /**
     * Prepare and send the response
     * @param mixed $content The content body
     * @param integer $status Http Status code
     * @return Response
     */
    public static function send($content, $status = Response::HTTP_OK)
    {
        return OutputFormatter::toJson(new Response, $content, $status);
    }
}
