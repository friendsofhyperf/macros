<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */

namespace FriendsOfHyperf\Macros;

use FriendsOfHyperf\Support\UuidContainer;
use Hyperf\Stringable\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\InlinesOnly\InlinesOnlyExtension;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\CommonMark\MarkdownConverter;
use voku\helper\ASCII;

/**
 * @mixin Str
 */
class StrMixin
{
    public function createUuidsNormally()
    {
        return fn () => UuidContainer::$uuidFactory = null;
    }

    public function createUuidsUsing()
    {
        return fn (?callable $factory = null) => UuidContainer::$uuidFactory = $factory;
    }

    public static function deduplicate()
    {
        return fn (string $string, string $character = ' ') => preg_replace('/' . preg_quote($character, '/') . '+/u', $character, $string);
    }

    public function inlineMarkdown()
    {
        return function ($string, array $options = []) {
            $environment = new Environment($options);

            $environment->addExtension(new GithubFlavoredMarkdownExtension());
            $environment->addExtension(new InlinesOnlyExtension());

            $converter = new MarkdownConverter($environment);

            return (string) $converter->convert($string);
        };
    }

    public function markdown()
    {
        return function ($string, array $options = [], array $extensions = []) {
            $converter = new GithubFlavoredMarkdownConverter($options);
            $environment = $converter->getEnvironment();

            foreach ($extensions as $extension) {
                $environment->addExtension($extension);
            }

            return (string) $converter->convert($string);
        };
    }

    public function transliterate()
    {
        return fn ($string, $unknown = '?', $strict = false) => ASCII::to_transliterate($string, $unknown, $strict);
    }

    public function doesntEndWith()
    {
        return function ($haystack, $needles) {
            return ! Str::endsWith($haystack, $needles);
        };
    }

    public function doesntStartWith()
    {
        return function ($haystack, $needles) {
            return ! Str::startsWith($haystack, $needles);
        };
    }
}
