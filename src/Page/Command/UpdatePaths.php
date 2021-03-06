<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class UpdatePaths
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PagesModule\Page\Command
 */
class UpdatePaths implements SelfHandling
{

    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new UpdatePaths instance.
     *
     * @param PageInterface $page
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     *
     * @param PageRepositoryInterface $pages
     */
    public function handle(PageRepositoryInterface $pages)
    {
        /* @var PageInterface $page */
        foreach ($this->page->getChildren() as $page) {
            if ($page->isEnabled()) {
                $pages->save($page->setPath($this->page->getPath() . '/' . $page->getSlug()));
            }
        }
    }
}
