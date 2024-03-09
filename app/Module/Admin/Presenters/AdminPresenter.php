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

	function renderContact() : void
	{
		$content = $this->contentFacade->getAllContent();
		$this->template->content = $content;
	}

	function renderAbout() : void
	{
		$content = $this->contentFacade->getAllContent();
		$this->template->content = $content;
	}

	function renderProjects() : void
	{
		$content = $this->contentFacade->getAllContent();
		$this->template->content = $content;
	}

	function renderProjectsedit(int $id): void
	{

	$image = $this->contentFacade->getContentById($id);
	if (!$image) {
		$this->error('image not found');
	}
	$imageArray = $image->toArray();
	$this->getComponent('editForm')
		->setDefaults($imageArray);
		$this->template->image = $image;
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

	protected function createComponentImageForm(): Form
	{
		$form = new Form;
		$form->addText('title', 'Titulek: ')
			->setRequired();
		$form->addUpload('image', 'Obrázek:')
    	    ->addRule(Form::IMAGE, 'Thumbnail must be JPEG, PNG or GIF')
			->setRequired();
		$tag = [
				'IMAGE' => 'Image',
				'CONTENT' => 'Content'
			];
		$form->addText('link', 'Link: ');
		$form->addSelect('tag', 'Tag', $tag)
			->setRequired();
		$form->addSubmit('send', 'Uložit')
			->setHtmlAttribute('class', '')
			->renderAsButton(True);
		$form->onSuccess[] = [$this, 'imageFormSucceeded'];
	
		return $form;
	}

	public function imageFormSucceeded($form, $data): void
	{
		$img = $data['image'];
		if ($img->isImage() && $img->isOk()) {
			$img = \Nette\Utils\Image::fromFile($img->getTemporaryFile());
			$img->save('images/' . $data['image']->getSanitizedName());
		}
		else {
			unset($data['image']);
			$data['image'] = null;
		}
		bdump($img);
		$this->contentFacade->insertImage($data["title"], 'images/' . $data['image']->getSanitizedName() , $data["tag"]);
		$this->redirect('Admin:projects');
	}

	protected function createComponentEditForm(): Form
	{
		$form = new Form;
		$form->addText('title', 'Titulek: ')
			->setRequired();
		$form->addUpload('image', 'Obrázek:')
    	    ->addRule(Form::IMAGE, 'Thumbnail must be JPEG, PNG or GIF')
			->setRequired();
		$tag = [
			'CONTENT' => 'Content',
			'IMAGE' => 'Image'
			];
		$form->addText('link', 'Link: ');
		$form->addSelect('tag', 'Tag', $tag)
			->setRequired();
		$form->addSubmit('send', 'Uložit')
			->setHtmlAttribute('class', '')
			->renderAsButton(True);
		$form->onSuccess[] = [$this, 'editFormSucceeded'];
	
		return $form;
	}

	public function EditFormSucceeded($form, $data): void
	{
		$imageId = $this->getParameter('id');
		$imageId = intval($imageId);

		if ($data['image']) {
			$data->image->move('upload/' . $data['image']->getSanitizedName());
		}
		else{
			unset($data->image);
		}

		if ($imageId) {
			$image = $this->contentFacade->editimage($imageId, $data);
		} else {
			$image = $this->contentFacade->insertimage($data);
		}
		$this->redirect('Admin:projects');
	}

	public function handleDeleteImage(int $id)
	{
		$id = $this->getParameter('id');
		$this->contentFacade->deleteImage(intval($id));
		$this->redirect('Admin:projects');
	}
}