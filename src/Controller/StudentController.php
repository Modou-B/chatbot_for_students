<?php

namespace App\Controller;

use App\Form\Chat\ChatMessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
//    #[Route('/old',name: 'app_homepage', methods: ['GET'])]
//    public function homepage(): Response
//    {
//        $tracks = [
//            ['song' => 'HYAENA', 'artist' => 'Travis Scott'],
//            ['song' => 'HYAENA', 'artist' => 'Travis Scott'],
//            ['song' => 'THANK GOD', 'artist' => 'Travis Scott'],
//            ['song' => 'MODERN JAM', 'artist' => 'Travis Scott'],
//            ['song' => 'MY EYES', 'artist' => 'Travis Scott'],
//            ['song' => 'GOD’S COUNTRY', 'artist' => 'Travis Scott'],
//            ['song' => 'SIRENS', 'artist' => 'Travis Scott'],
//            ['song' => 'MELTDOWN', 'artist' => 'Travis Scott'],
//            ['song' => 'FE!N', 'artist' => 'Travis Scott'],
//            ['song' => 'DELRESTO (ECHOES)', 'artist' => 'Travis Scott'],
//            ['song' => 'I KNOW ?', 'artist' => 'Travis Scott'],
//            ['song' => 'TOPIA TWINS', 'artist' => 'Travis Scott'],
//            ['song' => 'CIRCUS MAXIMUS', 'artist' => 'Travis Scott'],
//            ['song' => 'PARASAIL', 'artist' => 'Travis Scott'],
//            ['song' => 'SKITZO', 'artist' => 'Travis Scott'],
//            ['song' => 'LOST FOREVER', 'artist' => 'Travis Scott'],
//            ['song' => 'LOOOVE', 'artist' => 'Travis Scott'],
//            ['song' => 'K-POP', 'artist' => 'Travis Scott'],
//            ['song' => 'TELEKINESIS', 'artist' => 'Travis Scott'],
//            ['song' => 'TIL FURTHER NOTICE', 'artist' => 'Travis Scott'],
//        ];
//
//        return $this->render('student/homepage.html.twig', [
//            'title' => 'Question',
//            'tracks' => $tracks
//        ]);
//    }

    #[Route('/feedback_send', name: 'app_feedback' ,methods: ['POST'])]
    public function sendCurrentMsg(): Response
    {
        return  $this->render('student/submit.html.twig');
    }

    #[Route('/',name: 'app_chat', methods: ['GET', 'POST'])]
    public function chat(Request $request): Response
    {
//        $var = [
//            "netPrice" => 10,
//            "grossPrice" => 16,
//            "newTotal" => 25,
//            "grossTotal" => 30
//        ];
//
//        $result = 0;
//
//        foreach ($var as $key => $price) {
//            if (strpos($key, 'Price') !== false) {
//                $result = $result + $price;
//            }
//        }
//        dd($result);

// The ->request gets the body parameters and the -> all the values. I think important from arrays in arrays
// The request body is array ["meesage" => "TEST", "saveButton" =>  "", "messages" => "["", "BOT MESSAFE"]" ]
// So because I
        $requestData = $request->request->all('chat_message');

// New object of ChatEntry class
        $chatEntry = new ChatEntry();

// If the requestData variable has content
        if ($requestData) {
// The local variable "message" of the newly created chatEntry class gets filled
            $chatEntry->setMessage($requestData['message']?? '');
// The local variable "messages" of the newly created chatEntry class gets filled
            $chatEntry->setMessages($requestData['messages']?? '');
        }

// This is called "array destructuring". This is the shortened version. The longer version would be
// list($value, $value) = array
// The return parameter must be an array so that the two values inside the bracket can be automatically
// be filled
        [$chatEntry,$messages] = $this->createMessage($chatEntry);

// Creates a form from the chatEntry object
// that should be the reason why I can print out every message of the messages array
// in the chat twig file
        $form = $this->createForm(ChatMessageType::class, $chatEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            [$chatEntry,$messages] = $this->createMessage($form->getData());
            $form = $this->createForm(ChatMessageType::class, $chatEntry);

            return $this->render('student/chat.html.twig', [
                'messages' => $messages,
                'form' => $form
            ]);
    }


        return $this->render('student/chat.html.twig', [
            'messages' => $messages,
            'form' => $form
        ]);
    }

    protected function createMessage(ChatEntry $chatEntry): Array
    {
// The local variable "messages" of the chatEntry gets decoded from json into an array and the result lands in the
// new variable "messages"
// ?? is an operator that is called the null coalescing operator
// It can be used to check if the response is null then it uses the empty string '' as default
// The new messages array has the following: array = [0 => "", 1 => "BOT MESSAGE"]
        $messages = json_decode($chatEntry->getMessages()?? '');

// Adds the newest written message to the array.
// The new messages array has the following: array = [0 => "", 1 => "BOT MESSAGE", 2 => TEST]
        $messages[] = $chatEntry->getMessage();

// The algorithm for text identification has to be here
        $botCon = new BotController();

        if ($chatEntry->getMessage() != '') {
            $messages[] = $botCon->calculateAnswer($chatEntry->getMessage());
        } else {
            $messages[] = 'BOT MESSAGE';
        }

// The messages array that got filled with the written message and the response of the algorithm
// is getting encoded back again in json
        $result = json_encode($messages);

// The current full list of messages is getting saved in the chatEntry variable "messages"
// It was getting encoded in json because after that it is a string again that can be saved in the
// "messages" variable in the chatEntry object
        $chatEntry->setMessages($result);

// both the chatEntry object and the current message is getting returned
// chatEntry has in the variable "messages" the whole history as string and $messages has the history
// as array
        return [$chatEntry, $messages];
    }
}