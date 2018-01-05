<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Collection;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class PledgeRecords extends CountableProviderRecords
{
    private $linkedResources;

    public function __construct(
        \Iterator $providerRecords,
        int $count,
        ProviderResource $resource,
        array $linkedResources
    ) {
        parent::__construct($providerRecords, $count, $resource);

        $this->linkedResources = $linkedResources;
    }

    public function getLinkedResources(): array
    {
        return $this->linkedResources;
    }
}
