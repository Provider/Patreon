<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Patreon\Functional;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\Resource\GetPledges;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Patreon\FixtureFactory;

final class GetPledgesTest extends TestCase
{
    public function test(): void
    {
        /** @var PledgeRecords $pledges */
        $pledges = FixtureFactory::createPorter()->import(new ImportSpecification(new GetPledges(1405455)))
            ->findFirstCollection();

        $firstPledge = $pledges->current();
        self::assertArrayHasKey('id', $firstPledge);
        self::assertArrayHasKey('type', $firstPledge);
        self::assertSame('pledge', $firstPledge['type']);

        self::assertArrayHasKey('attributes', $firstPledge);
        self::assertInternalType('array', $attributes = $firstPledge['attributes']);
        self::assertNotEmpty($attributes);

        self::assertArrayHasKey('relationships', $firstPledge);
        self::assertArrayHasKey('patron', $relationships = $firstPledge['relationships']);
        self::assertArrayHasKey('reward', $relationships);

        $resources = $pledges->getLinkedResources();
        self::assertGreaterThan(1, \count($resources));
    }
}
