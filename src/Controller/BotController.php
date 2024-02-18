<?php

namespace App\Controller;

class BotController
{


    public function fillAnswers(): Bot
    {
        $data = array(
            "KLASSE" => "Es gibt 10 Klasenräume.",
            "PAUSE" => "Während den Pausen dürfen sich Schüler nicht in den Klassenräumen oder dem Flur aufhalten.",
        );

//        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        $bot = new Bot();
        $bot->setAnswers($data);

        return $bot;
    }


    public function calculateAnswer(string $question): string
    {
        $bot = $this->fillAnswers();
        return $bot->calcAnswers($question);
    }
}