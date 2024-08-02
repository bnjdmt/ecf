<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $questionText;

    #[ORM\Column(type: 'json')]
    private $choices = [];

    #[ORM\Column(type: 'string', length: 255)]
    private $correctAnswer;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }

    /**
     * @param mixed $questionText
     */
    public function setQuestionText($questionText): void
    {
        $this->questionText = $questionText;
    }

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function setChoices(array $choices): void
    {
        $this->choices = $choices;
    }

    /**
     * @return mixed
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    /**
     * @param mixed $correctAnswer
     */
    public function setCorrectAnswer($correctAnswer): void
    {
        $this->correctAnswer = $correctAnswer;
    }
}
