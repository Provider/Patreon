<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Resource;

use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetPledges implements ProviderResource
{
    private $campaignId;

    public function __construct(int $campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function getProviderClassName(): string
    {
        return PatreonProvider::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $response = \json_decode(
            (string)$connector->fetch(
                PatreonProvider::buildPatreonApiUrl(
                    "campaigns/$this->campaignId/pledges?include=patron.null,reward.null&page%5Bcount%5D=1000"
                )
            ),
            true
        );

        return new PledgeRecords(
            (function () use ($response) {
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
