<?php

declare(strict_types=1);

namespace App\Module\Front\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\ContentFacade;
use App\Model\SecurityFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private ContentFacade $contentFacade;
    private SecurityFacade $securityFacade;
    
    function __construct(ContentFacade $contentFacade, SecurityFacade $securityFacade)
    {
        $this->contentFacade = $contentFacade;
        $this->securityFacade = $securityFacade;
    }

    public function renderDefault(): void
    {
        $content = $this->contentFacade->getAllContent();
        $this->template->content = $content;
    }
}