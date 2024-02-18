<?php

namespace App\Controller;

class Bot
{
    private array $answers = [];

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @param array $answers
     */
    public function setAnswers(array $answers)
    {
        $this->answers = $answers;
    }

    public function calcAnswers(string $question): string
    {
        foreach ($this->getAnswers() as $key => $value) {
            if (strpos(strtoupper($question), $key) !== false) {
                return $value;
            }
        }
        return 'I dont have an answer for this!';
    }

}