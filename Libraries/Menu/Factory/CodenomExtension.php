<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Menu\Factory;

use Knp\Menu\Factory\ExtensionInterface;
use Knp\Menu\ItemInterface;

class CodenomExtension implements ExtensionInterface
{
    public function buildOptions(array $options): array
    {
        return array_merge(array("uri" => null, "badge" => null, "order" => null, "icon" => null, "headingHtml" => null, "bodyHtml" => null, "footerHtml" => null, "disabled" => false), $options);
    }

    public function buildItem(ItemInterface $item, array $options): void
    {
        $item->setUri($options["uri"])->setBadge($options["badge"])->setOrder($options["order"])->setIcon($options["icon"])->setHeadingHtml($options["headingHtml"])->setBodyHtml($options["bodyHtml"])->setFooterHtml($options["footerHtml"]);
        if ($options["disabled"]) {
            $item->disable();
        }
    }
}
