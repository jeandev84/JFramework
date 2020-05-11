<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Message\ResponseInterface;


/**
 * Class Response
 * @package Jan\Component\Http
*/
class Response implements ResponseInterface
{

    use StatusCode;

    /**
     * @var string $protocolVersion
     * @var string $content
     * @var int $status
     * @var array $headers
    */
    protected $protocolVersion;
    protected $content;
    protected $status;
    protected $headers = [];


    /**
     * Response constructor.
     * @param string|null $content
     * @param int $status
     * @param array $headers
    */
    public function __construct(string $content = null, int $status = 200, array $headers = [])
    {
        $this->setContent($content);
        $this->setStatus($status);
        $this->setHeaders($headers);
        $this->setProtocolVersion('HTTP/1.1');
    }


    /**
     * @return string
    */
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }


    /**
     * @param string $protocolVersion
     * @return Response
    */
    public function setProtocolVersion(string $protocolVersion): Response
    {
        $this->protocolVersion = $protocolVersion;
        return $this;
    }


    /**
     * @return string|null
    */
    public function getContent(): ?string
    {
        return $this->content;
    }


    /**
     * @param string|null $content
    */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }

    /**
     * @return int
    */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
    */
    public function setStatus(int $status)
    {
        $this->status = $status;;
    }

    /**
     * @return array
    */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
    */
    public function setHeaders(array $headers)
    {
         $this->headers = $headers;
    }


    /**
     * @param string|null $content
     * @return Response
   */
    public function withBody(?string $content): Response
    {
        $this->setContent($content);
        return $this;
    }

    /**
     * @param int $status
     * @return Response
    */
    public function withStatus(int $status): Response
    {
        $this->setStatus($status);
        return $this;
    }


    /**
     * @param bool $http
    */
    public function redirect($http = false)
    {

    }


    /**
     * @param $name
     * @param $value
     * @return Response
    */
    public function withHeader($name, $value): Response
    {
        $this->headers[] = [$name => $value];
        return $this;
    }


    /**
     * @param $body
     * @return $this
    */
    public function withJson($body)
    {
        $this->withHeader('Content-Type', 'application/json');
        $this->content = json_encode($body);
        return $this;
    }


    /**
     * @throws \Exception
    */
    public function send()
    {
        if(headers_sent())
        {
            # look for may be return $this or body like this $this->sendBody()
            return $this;
        }

        header(sprintf('%s %s %s', $this->protocolVersion, $this->status, $this->codeMessage()));
        $this->sendHeaders();
        $this->sendBody();
    }

    /**
     *
    */
    public function sendBody()
    {
        echo $this->content;
    }


    /**
     * @return void
    */
    public function sendHeaders()
    {
       if(! headers_sent())
       {
           foreach ($this->headers as $name => $value)
           {
               header($name.': '. $value);
           }
       }
    }


    /**
     * @return string
     * @throws \Exception
    */
    private function codeMessage()
    {
        if(! array_key_exists($this->status, $this->messages))
        {
             throw new \Exception(
                 sprintf('Code %s is not available', $this->status)
             );
        }
        return $this->messages[$this->status];
    }
}