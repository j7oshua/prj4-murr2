<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="The ID has to be zero or a positive number.")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=200)
     * @Assert\Length(max="200", maxMessage="Title cannot be longer than {{ limit }} characters.")
     * @Assert\NotBlank(message="Title cannot be blank.")
     */
    private $title;

    /**
     * @ORM\Column (type="string")
     * @Assert\Url(message="Must be valid image url.")
     */
    private $image;

    /**
     * @ORM\Column (type="string")
     * @Assert\Length (min="20", max="3000", minMessage="An Article must be at least {{ limit }} characters long.",
     *     maxMessage="An Article must be less than {{ limit }} characters long.")
     */
    private $info;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info): void
    {
        $this->info = $info;
    }
}