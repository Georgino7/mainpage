<?php

declare(strict_types=1);

namespace App\Module\Admin\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\ContentFacade;
use App\Model\SecurityFacade;

final class SecurityPresenter extends Nette\Application\UI\Presenter
{
    private ContentFacade $contentFacade;
    private SecurityFacade $securityFacade;


    public function __construct(ContentFacade $contentFacade, SecurityFacade $securityFacade)
	{
		$this->contentFacade = $contentFacade;
        $this->securityFacade = $securityFacade;
	}

    protected function createComponentSignInForm(): Form 
	{
		$form = new Form;
		$form->addText('username', '')
			->setRequired('Prosím vyplňte své uživatelské jméno.')
			->setHtmlAttribute('placeholder', 'Uživatelské jméno');

		$form->addPassword('password', '')
			->setRequired('Prosím vyplňte své heslo.')
			->setHtmlAttribute('placeholder', 'Heslo');

		$form->addSubmit('send', 'Přihlásit')
			->setHtmlAttribute('class', '')
			->renderAsButton(True);

		$form->onSuccess[] = [$this, 'signInFormSucceeded'];
		return $form;
	}
	public function signInFormSucceeded(Form $form, \stdClass $data): void
	{
		try {
			$this->getUser()->login($data->username, $data->password);
			$this->redirect('Admin:');
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError('Nesprávné přihlašovací jméno nebo heslo.');
		}
	}

    public function actionOut(): void 
	{
		$this->getUser()->logout();
		$this->redirect('Security:login');
	}

}