<?php

namespace ScriptFUSIONTest\Porter\Provider\Patreon;

use Psr\Container\ContainerInterface;
use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Patreon\Connector\PatreonConnector;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\StaticClass;

final class FixtureFactory
{
    use StaticClass;

    public static function createPorter(string $key = null): Porter
    {
        return new Porter(
            \Mockery::mock(ContainerInterface::class)
                ->shouldReceive('has')
                    ->with(PatreonProvider::class)
                    ->andReturn(true)
                ->shouldReceive('get')
                    ->with(PatreonProvider::class)
                    ->andReturn(new PatreonProvider(new PatreonConnector($key ?? $_SERVER['PATREON_API_KEY'])))
                ->getMock()
        );
    }

    public static function createPorterV2(): Porter
    {
        return self::createPorter($_SERVER['PATREON_API_KEY_V2']);
    }
}
