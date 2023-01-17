<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Resource;

use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

final class GetPledges implements ProviderResource
{
    public function __construct(private readonly int $campaignId)
    {
    }

    public function getProviderClassName(): string
    {
        return PatreonProvider::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $response = \json_decode(
            (string)$connector->fetch(new HttpDataSource(
                PatreonProvider::buildPatreonApiUrl(
                    "campaigns/$this->campaignId/pledges?include=patron.null,reward.null&page%5Bcount%5D=1000"
                )
            )),
            true
        );

        return new PledgeRecords(
            (static function () use ($response) {
                foreach ($response['data'] as $datum) {
                    yield $datum;
                }
            })(),
            $response['meta']['count'],
            $this,
            $response['included']
        );
    }
}
