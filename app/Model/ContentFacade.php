<?php
namespace App\Model;

use Nette;
use Nette\SmartObject;

final class ContentFacade
{
    use Nette\SmartObject;

    private const
    TableContent = 'content',
    ColumnId = 'id',
    ColumnTitle = 'title',
    ColumnText = 'text',
        ColumnImage = 'image',
        ColumnTag = 'tag';
    
    private Nette\Database\Explorer $database;

    function __construct(Nette\Database\Explorer $database)
    {
        $this->database = $database;
    }

    public function getAllContent()
    {
        return $this->database
			->table('content')
			->fetchAll();
    }
	
	public function getContentById(int $id)
	{      
		return $this->database
			->table('content')
			->get($id);
	}

    public function insertContent(int $id, $data)
	{
		$image = $this->database
			->table('content')
            ->get($id)
			->update([
				self::ColumnTitle => $data["title"],
				self::ColumnText => $data["text"]
			]);
		return $image;
	}

    public function insertImage($title , $link , $tag)
	{
		$image = $this->database
			->table('content')
			->insert([
				self::ColumnTitle => $title,
				self::ColumnImage => $link,
				self::ColumnTag => $tag
			]);
		return $image;
	}

	public function editImage(int $id, $title , $link , $tag)
	{
		$image = $this->database
			->table('content')
			->get($id);
		$image->update([
			self::ColumnTitle => $title,
			self::ColumnImage => $link,
			self::ColumnTag => $tag
		]);
		return $image;
	}

	public function deleteImage(int $id)
	{
		$this->database
		->table('content')
		->where('id', $id)
		->delete();
	}
}