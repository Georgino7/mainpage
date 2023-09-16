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

    public function renderAbout(): void
    {
        $content = $this->contentFacade->getAllContent();
        $this->template->content = $content;
    }

    public function renderContact(): void
    {
        $content = $this->contentFacade->getAllContent();
        $this->template->content = $content;
    }

    public function createComponentContactForm(): Form
	{
		$form = new Form;
		$form->addText('name', '')
            ->setHtmlAttribute('placeholder', 'Jméno');
        $form->addText('email', '')
            ->setHtmlAttribute('placeholder', 'Váš e-mail');
        $subject = [
            'WEB' => 'Web',
            'WEB + GRAFIKA' => 'Web + Grafika',
            'GRAFIKA' => 'Grafika',
            'HRA' => 'Hra'
        ];
        $form->addSelect('subject', 'Předmět', $subject)
            ->setRequired();
		$form->addTextarea('text', '')
			->setRequired('Zadejte Text');
		$form->addSubmit('send', 'Odeslat')
            ->renderAsButton(True);
        

		$form->onSuccess[] = [$this, 'emailFormSucceeded'];
		return $form;
	}

	public function emailFormSucceeded(Form $form, array $data)
	{

        bdump($data);
        $mail = new Nette\Mail\Message;
        $mailer = new Nette\Mail\SendmailMailer;
    $mail->setFrom($data['email'])
	->addTo('placek.nafu@gmail.com')
	->addTo('vavru.nafu@gmail.com')
	->setSubject($data['subject'])
	->setBody($data['text']);
    $mailer->send($mail);
    bdump($mail);
        $this->redirect(":contact");
	}
}