<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) 2015 Martin Hasoň <martin.hason@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace League\CommonMark\Extension\Attributes\Parser;

use League\CommonMark\Extension\Attributes\Node\AttributesInline;
use League\CommonMark\Extension\Attributes\Util\AttributesHelper;
<<<<<<< HEAD
=======
use League\CommonMark\Inline\Element\Text;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\InlineParserContext;

final class AttributesInlineParser implements InlineParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCharacters(): array
    {
<<<<<<< HEAD
        return [' ', '{'];
=======
        return ['{'];
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();
<<<<<<< HEAD
        if ($cursor->getNextNonSpaceCharacter() !== '{') {
            return false;
        }

        $char = $cursor->getCharacter();
        if ($char === '{') {
            $char = (string) $cursor->getCharacter($cursor->getPosition() - 1);
        }
=======

        $char = (string) $cursor->peek(-1);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

        $attributes = AttributesHelper::parseAttributes($cursor);
        if ($attributes === []) {
            return false;
        }

<<<<<<< HEAD
=======
        if ($char === ' ' && ($previousInline = $inlineContext->getContainer()->lastChild()) instanceof Text) {
            $previousInline->setContent(\rtrim($previousInline->getContent(), ' '));
        }

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        if ($char === '') {
            $cursor->advanceToNextNonSpaceOrNewline();
        }

        $node = new AttributesInline($attributes, $char === ' ' || $char === '');
        $inlineContext->getContainer()->appendChild($node);

        return true;
    }
}
