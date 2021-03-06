<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class SetPath
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PagesModule\Page\Command
 */
class SetPath implements SelfHandling
{

    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new SetPath instance.
     *
     * @param PageInterface $page
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->page->isEnabled()) {
            $this->page->path = 'pages/preview/' . $this->page->getStrId();
        } else {
            if ($parent = $this->page->getParent()) {
                if ($parent->isHome()) {
                    $this->page->path = $parent->getSlug() . '/' . $this->page->getSlug();
                } else {
                    $this->page->path = $parent->getPath() . '/' . $this->page->getSlug();
                }
            } elseif ($this->page->isHome()) {
                $this->page->path = '/';
            } else {
                $this->page->path = $this->page->getSlug();
            }
        }
    }
}
