<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Connector;

use ScriptFUSION\Porter\Connector\DataSource;
use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Net\Http\HttpResponse;

class PatreonConnector extends HttpConnector
{
    public function __construct(private ?string $apiKey = null)
    {
        parent::__construct();
    }

    public function fetch(DataSource $source): HttpResponse
    {
        if (!$source instanceof HttpDataSource) {
            throw new \RuntimeException('Source must be of type: HttpDataSource.');
        }

        $source->addHeader('authorization', "Bearer $this->apiKey");

        return parent::fetch($source);
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }
}
