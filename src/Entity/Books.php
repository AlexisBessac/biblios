<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner le titre du livre.',
    )]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Le titre du livre doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Le titre du livre ne peut pas dépasser {{ limit }} caractères.',
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner le résumé du livre.',
    )]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le résumé du livre doit faire au minimum {{ limit }} caractères.',
    )]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez télécharger une image.")]
    #[Assert\Image(
        mimeTypes: ["image/jpeg", "image/png", "image/webp"],
        mimeTypesMessage: "Veuillez télécharger une image valide (JPEG, PNG ou WEBP)."
    )]
    private ?string $cover = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner le nombre de pages.',
    )]
    #[Assert\Positive(
        message: 'Le nombre de pages doit être un nombre positif.',
    )]
    private ?int $page_number = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner la date de publication.',
    )]
    #[Assert\Type(
        type: \DateTimeImmutable::class,
        message: 'La date de publication doit être une date valide.',
    )]
    private ?\DateTimeImmutable $published_at = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?author $author = null;

    /**
     * @var Collection<int, genre>
     */
    #[ORM\ManyToMany(targetEntity: genre::class, inversedBy: 'books')]
    private Collection $genre;

    /**
     * @var Collection<int, Comments>
     */
    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'books')]
    private Collection $comments;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getPageNumber(): ?int
    {
        return $this->page_number;
    }

    public function setPageNumber(int $page_number): static
    {
        $this->page_number = $page_number;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeImmutable $published_at): static
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getAuthor(): ?author
    {
        return $this->author;
    }

    public function setAuthor(?author $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(genre $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(genre $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setBooks($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBooks() === $this) {
                $comment->setBooks(null);
            }
        }

        return $this;
    }
}
