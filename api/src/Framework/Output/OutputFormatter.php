<?php

namespace SignupFormTest\Framework\Output;

use Symfony\Component\HttpFoundation\Response;

class OutputFormatter
{
    /**
     * Prepare de response to JSON
     * @param Response $response The response instance
     * @param mixed $content The content body
     * @param integer $status Http Status code
     * @return Response
     */
    public static function toJson(Response $response, $content, $status)
    {
        if (!is_array($content) && !is_object($content)) {
            $content = array($content);
        }

        $response->setContent(json_encode($content));
        $response->headers->set('Content-Type', 'application/json');
        $response->setCharset('UTF-8');
        $response->setStatusCode($status);

        return $response;
    }
}
