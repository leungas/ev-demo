<?php
    use PHPUnit\Framework\TestCase;
    use MyApp\TestClass;
    use MyApp\Exceptions\RemoteItemNotFoundException;
    use GuzzleHttp\Client;
    use GuzzleHttp\Handler\MockHandler;
    use GuzzleHttp\HandlerStack;
    use GuzzleHttp\Psr7\Response;

    /**
     * here is our test case to run via PHPUnit
     * @author Mark Leung
     */
    class ExampleCaseTest extends TestCase {

        /**
         * our main test for 404 response
         * @return void
         */
        public function testGettingNotFound() {
            $this->expectException(RemoteItemNotFoundException::class);
            $object = $this->getClientResponse(404);
            $object->get("Some Data");

        }

        /**
         * this is our function to stub the response back
         * @param   int     $status         status code to return
         * @param   array   $body           (optional) the body data fto return
         * @return  TestClass
         */
        private function getClientResponse(int $status, array $body = null) {
            $data = new MockHandler([new Response($status, [], $body)]);
            $handler = HandlerStack::create($data);
            $client = new Client(["handler" => $handler]);
            return new TestClass($client, "http://mock.destination.xyz");
        }
    }
