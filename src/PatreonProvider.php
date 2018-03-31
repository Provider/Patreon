<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Provider\Provider;

class PatreonProvider implements Provider
{
    private const PATREON_API_URL = 'https://www.patreon.com/api/oauth2/api/';

    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public static function buildPatreonApiUrl(string $url): string
    {
        return self::PATREON_API_URL . $url;
    }

    public function getConnector(): Connector
    {
        return $this->connector;
    }
}
