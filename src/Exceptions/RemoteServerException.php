<?php
    namespace MyApp\Exceptions;

    use \Exception;

    /**
     * another example to show how the code can flow between 404 and other codes
     * @author Mark Leung
     */
    class RemoteServerException extends Exception {

        /**
         * our default pass-on constructor
         * @param string    $message        the message to log
         * @param int       $code           (default = 500) the code to send the exception as
         */
        function __construct(string $message, int $code = 500) {
            parent::__construct($message, $code);
        }

    }