<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/macros.
 *
 * @link     https://github.com/friendsofhyperf/macros
 * @document https://github.com/friendsofhyperf/macros/blob/1.x/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\Macros\Tests;

/**
 * @internal
 * @coversNothing
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }
}
