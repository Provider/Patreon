<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Patreon\Mapping;

use ScriptFUSION\Mapper\Mapping;
use ScriptFUSION\Mapper\Strategy\Copy;
use ScriptFUSION\Mapper\Strategy\Filter;
use ScriptFUSION\Mapper\Strategy\Merge;

class MemberPledgeTierMapping extends Mapping
{
    protected function createMapping()
    {
        return new Merge(new Filter(['id' => new Copy('id')]), new Copy('attributes'));
    }
}
