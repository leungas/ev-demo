<?php
    namespace MyApp;

    // loading our Guzzle Framework for PSR7 access
    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\ClientException;
    use GuzzleHttp\Psr7\Response;
    use GuzzleHttp\Psr7\Request;

    // our exception in the case turns south...
    use MyApp\Exceptions\RemoteItemNotFoundException;
    use MyApp\Exceptions\RemoteServerException;

    // some other general exception nice to have
    use \Throwable;
    use \InvalidArgumentException;

    /**
     * this is a test class with a Guzzle client and sending a GET request
     * @author Mark Leung
     */
    class TestClass {

        private $client;
        private $destination; 

        /**
         * our constructor, just sync the attributes
         * @param Client    $client     the client we are using for transmission 
         * @param string    $uri        the destination we are working with
         * @return void
         */
        function __construct(Client $client, string $uri) {
            $this->client = $client;
            $this->destination = $uri;
        }

        /**
         * our main function for the sake for a quick demo
         * @param string    $endpoint   the endpoint to call
         * @return mixed
         * @throws RemoteServerException
         */
        public function get(string $endpoint) {
            try {
                $response = $this->client->request("GET", $this->destination."/".$endpoint);    /** @var Response   $response   our response from remote side */
                $content = $response->getBody();                                                /** @var Strean     $content    our main part of our response (if received) */
                return $content->getContents();
            } catch (ClientException $ex) {
                switch ($ex->getCode()) {
                    case 404:
                        throw new RemoteItemNotFoundException("What we are looking for is not there...");
                        break;
                    default:
                        throw new RemoteServerException("Something else goes wrong... we have to find out.");
                }                
            } catch (Throwable $ex) {
                throw $ex;
            }   
        }
    }