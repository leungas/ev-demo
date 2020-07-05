<?php
    namespace MyApp\Exceptions;
    use \Exception;

    /**
     * a specific example to demo we are catching the 404
     * @author Mark Leung
     */
    class RemoteItemNotFoundException extends Exception {

        /**
         * a general pass-on constructor
         * @param string    $message    the message we want to log out
         * @param int       $code       (default = 404) the code to insert
         */
        function __construct(string $message, int $code = 404) {
            parent::__construct($message, $code);
        }
    }