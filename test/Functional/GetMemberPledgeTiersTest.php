<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Patreon\Functional;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Porter\Provider\Patreon\Resource\GetMemberPledgeTiers;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Patreon\FixtureFactory;

/**
 * @see GetMemberPledgeTiers
 */
final class GetMemberPledgeTiersTest extends TestCase
{
    public function testHasPledge(): void
    {
        $tiers = FixtureFactory::createPorterV2()->import(
            new ImportSpecification(new GetMemberPledgeTiers('d4c43409-8b36-41e4-ae3f-7bcbe1e84c3f'))
        );

        $firstTier = $tiers->current();

        self::assertArrayHasKey('attributes', $firstTier);
        self::assertIsArray($attributes = $firstTier['attributes']);
        self::assertArrayHasKey('title', $attributes);
        self::assertNotEmpty($attributes['title']);
    }

    public function testHasNoPledge(): void
    {
        $tiers = FixtureFactory::createPorterV2()->import(
            new ImportSpecification(new GetMemberPledgeTiers('b892e613-114a-4e97-be5c-5c79446a21cc'))
        );

        $firstTier = $tiers->current();

        self::assertEmpty($firstTier);
    }
}
