<?php
namespace App\Model;

use App\Helpers\Text;
use DateTime;

class Post {
    
    private $id;
    private $slug;
    private $name;
    private $content;
    private $created_at;
    private $category;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getFormattedContent(): ?string
    {
        return nl2br(e($this->content));
    }

    public function getExcerpt(): ?string
    {
        if($this->content === null) {
            return null;
        }
        return htmlentities(Text::exerpt($this->content, 60));
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getSlug(): ?string //return string or null
    {
        return   $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function addCategory(Category $category): void
    {
        $this->category = $category;
    }
}