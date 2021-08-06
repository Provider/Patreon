<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Mapping;

use ScriptFUSION\Mapper\Mapping;
use ScriptFUSION\Mapper\Strategy\Copy;

class MemberPledgeTierMapping extends Mapping
{
    protected function createMapping()
    {
        return [new Copy('attributes->title')];
    }
}
