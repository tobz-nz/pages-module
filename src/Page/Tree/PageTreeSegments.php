<?php namespace Anomaly\PagesModule\Page\Tree;

use Anomaly\PagesModule\Page\Contract\PageInterface;

/**
 * Class PageTreeSegments
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PagesModule\Page\Tree
 */
class PageTreeSegments
{

    /**
     * Handle the tree segments.
     *
     * @param PageTreeBuilder $builder
     */
    public function handle(PageTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                'entry.edit_link',
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-success',
                    'value'       => '<i class="fa fa-home"></i>',
                    'attributes'  => [
                        'title' => 'module::message.home'
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return $entry->isHome();
                    }
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-muted',
                    'value'       => '<i class="fa fa-chain-broken"></i>',
                    'attributes'  => [
                        'title' => 'module::message.hidden'
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return !$entry->isVisible();
                    }
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-danger',
                    'value'       => '<i class="fa fa-ban"></i>',
                    'attributes'  => [
                        'title' => 'module::message.disabled'
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return !$entry->isEnabled();
                    }
                ]
            ]
        );
    }
}
