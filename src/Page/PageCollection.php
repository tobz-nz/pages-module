<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PageCollection
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PagesModule\Page
 */
class PageCollection extends EntryCollection
{

    /**
     * Return only enabled pages.
     *
     * @return PageCollection
     */
    public function enabled()
    {
        return self::make(
            array_filter(
                $this->items,
                function ($page) {

                    /* @var PageInterface $page */
                    return $page->isEnabled();
                }
            )
        );
    }

    /**
     * Return only top level pages.
     *
     * @return PageCollection
     */
    public function topLevel()
    {
        return self::make(
            array_filter(
                $this->items,
                function ($page) {

                    /* @var PageInterface $page */
                    return !$page->getParentId();
                }
            )
        );
    }

    /**
     * Return only children of
     * the provided parent.
     *
     * @param PageInterface $parent
     * @return PageCollection
     */
    public function children(PageInterface $parent)
    {
        return self::make(
            array_filter(
                $this->items,
                function ($page) use ($parent) {

                    /* @var PageInterface $page */
                    return $page->getParentId() == $parent->getId();
                }
            )
        );
    }
}
