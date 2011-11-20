<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialGood\ExploreCardiff\AdminBundle\Entity\Challenge
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Challenge
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $question
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string $answer1
     *
     * @ORM\Column(name="answer1", type="string", length=255)
     */
    private $answer1;

    /**
     * @var string $answer2
     *
     * @ORM\Column(name="answer2", type="string", length=255)
     */
    private $answer2;

    /**
     * @var string $answer3
     *
     * @ORM\Column(name="answer3", type="string", length=255)
     */
    private $answer3;

    /**
     * @var string $answer4
     *
     * @ORM\Column(name="answer4", type="string", length=255)
     */
    private $answer4;

    /**
     * @var integer $correctAnswer
     *
     * @ORM\Column(name="correctAnswer", type="integer")
     */
    private $correctAnswer;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer1
     *
     * @param string $answer1
     */
    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;
    }

    /**
     * Get answer1
     *
     * @return string 
     */
    public function getAnswer1()
    {
        return $this->answer1;
    }

    /**
     * Set answer2
     *
     * @param string $answer2
     */
    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;
    }

    /**
     * Get answer2
     *
     * @return string 
     */
    public function getAnswer2()
    {
        return $this->answer2;
    }

    /**
     * Set answer3
     *
     * @param string $answer3
     */
    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;
    }

    /**
     * Get answer3
     *
     * @return string 
     */
    public function getAnswer3()
    {
        return $this->answer3;
    }

    /**
     * Set answer4
     *
     * @param string $answer4
     */
    public function setAnswer4($answer4)
    {
        $this->answer4 = $answer4;
    }

    /**
     * Get answer4
     *
     * @return string 
     */
    public function getAnswer4()
    {
        return $this->answer4;
    }

    /**
     * Set correctAnswer
     *
     * @param integer $correctAnswer
     */
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
    }

    /**
     * Get correctAnswer
     *
     * @return integer 
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }
}