<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Connector;

use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Net\Http\HttpOptions;

class PatreonConnector extends HttpConnector
{
    private $options;

    public function __construct(string $apiKey)
    {
        parent::__construct($this->options = (new HttpOptions)->addHeader("Authorization: Bearer $apiKey"));
    }
}
