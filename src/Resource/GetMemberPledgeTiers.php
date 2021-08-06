<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Resource;

use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetMemberPledgeTiers implements ProviderResource
{
    private const URL = 'https://www.patreon.com/api/oauth2/v2/members/%s'
        . '?include=currently_entitled_tiers&fields%%5btier%%5d=title';

    private $memberId;

    public function __construct(string $memberId)
    {
        $this->memberId = $memberId;
    }

    public function getProviderClassName(): string
    {
        return PatreonProvider::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        yield from \json_decode(
            (string)$connector->fetch(new HttpDataSource(sprintf(self::URL, $this->memberId))),
            true
        )['included'] ?? [[]];
    }
}
