<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Patreon\Functional;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Porter\Provider\Patreon\Mapping\MemberPledgeTierMapping;
use ScriptFUSION\Porter\Provider\Patreon\Resource\GetMemberPledgeTiers;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSION\Porter\Transform\Mapping\MappingTransformer;
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

        self::assertArrayHasKey('id', $firstTier);
        self::assertArrayHasKey('attributes', $firstTier);
        self::assertIsArray($attributes = $firstTier['attributes']);
        self::assertArrayHasKey('title', $attributes);
        self::assertNotEmpty($attributes['title']);
    }

    public function testHasPledgeWithMapping(): void
    {
        $tiers = FixtureFactory::createPorterV2()->import(
            (new ImportSpecification(new GetMemberPledgeTiers('d4c43409-8b36-41e4-ae3f-7bcbe1e84c3f')))
                ->addTransformer(new MappingTransformer(new MemberPledgeTierMapping()))
        );

        $firstTier = $tiers->current();

        self::assertIsArray($firstTier);
        self::assertArrayHasKey('id', $firstTier);
        self::assertNotEmpty($firstTier['id']);
        self::assertArrayHasKey('title', $firstTier);
        self::assertNotEmpty($firstTier['title']);
    }

    public function testHasNoPledge(): void
    {
        $tiers = FixtureFactory::createPorterV2()->import(
            new ImportSpecification(new GetMemberPledgeTiers('b892e613-114a-4e97-be5c-5c79446a21cc'))
        );

        $firstTier = $tiers->current();

        self::assertEmpty($firstTier);
    }

    public function testHasNoPledgeWithMapping(): void
    {
        $tiers = FixtureFactory::createPorterV2()->import(
            (new ImportSpecification(new GetMemberPledgeTiers('b892e613-114a-4e97-be5c-5c79446a21cc')))
                ->addTransformer(new MappingTransformer(new MemberPledgeTierMapping()))
        );

        $firstTier = $tiers->current();

        self::assertIsArray($firstTier);
        self::assertCount(0, $firstTier);
        self::assertArrayNotHasKey('id', $firstTier);
        self::assertArrayNotHasKey('title', $firstTier);
    }
}
