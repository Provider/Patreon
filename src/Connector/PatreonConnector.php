<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Connector;

use ScriptFUSION\Porter\Connector\DataSource;
use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Net\Http\HttpResponse;

class PatreonConnector extends HttpConnector
{
    private $apiKey;

    public function __construct(string $apiKey = null)
    {
        parent::__construct();

        $this->apiKey = $apiKey;
    }

    public function fetch(DataSource $source): HttpResponse
    {
        if (!$source instanceof HttpDataSource) {
            throw new \RuntimeException('Source must be of type: HttpDataSource.');
        }

        $source->addHeader("Authorization: Bearer $this->apiKey");

        return parent::fetch($source);
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }
}
