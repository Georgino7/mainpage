<?php

declare(strict_types=1);

namespace App\Module\Admin\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\ContentFacade;
use App\Model\SecurityFacade;

final class AdminPresenter extends Nette\Application\UI\Presenter
{
    private ContentFacade $contentFacade;
    private SecurityFacade $securityFacade;
    
    function __construct(ContentFacade $contentFacade, SecurityFacade $securityFacade)
    {
        $this->contentFacade = $contentFacade;
        $this->securityFacade = $securityFacade;
    }

    function startup() : void {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('Security:login');
		}
		
    }

	function renderHome() : void
	{
		$content = $this->contentFacade->getAllContent();
		$this->template->content = $content;
	}
	
	public function renderContentedit(int $id): void
	{
		
	}

    public function createComponentContentForm(): Form 
	{
		$contentId = $this->getParameter('id');
		$content = $this->contentFacade->getContentById(intval($contentId));
		$form = new Form;
		$form->addText('title', 'Titulek:')
			->setDefaultValue($content['title']);
		$form->addTextarea('text', 'Text: ')
			->setRequired('Zadejte Text')
			->setDefaultValue($content['text']);

		$form->addSubmit('send', 'Upravit')
			->setHtmlAttribute('onclick', 'javascript:window.history.back(-2);')
			->renderAsButton(True);
        

		$form->onSuccess[] = [$this, 'contentFormSucceeded'];
		return $form;
	}

	public function contentFormSucceeded(Form $form, array $data)
	{
		$contentId = $this->getParameter('id');
		$this->contentFacade->insertContent(intval($contentId), $data);
        $this->redirect("Admin:default");
	}
}