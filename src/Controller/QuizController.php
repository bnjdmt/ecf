<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'quiz')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {

//        $data = $request->query->all();
//        if (isset($data) && $data !== null) {
//            dump($data);
//        }
//
//        $question = $em->getRepository(Question::class)->findOneBy(['id' => 1]);
//
//        $form = $this->createForm(QuestionType::class, $question);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            // Traitez le formulaire soumis
//            // Par exemple, enregistrez la question dans la base de données
////            dd($question);
//
//            $score = 0;
//
//            if ($question->getCorrectAnswer() === $question->getChoices()) {
//                $score += 10;
//            }else {
//                $score -= 5;
//            }
//            $score <= 0 ? $score = 0 : $score;
//
//            return $this->redirectToRoute('quiz', [
//                'score' => $score,
//                'questionId' => $question->getId(),
//            ]);
//
//            return $this->redirectToRoute('quiz_submit', [
//                'question' => $question
//            ]);
//        }

//        return $this->render('quiz/index.html.twig', [
//            'form' => $form->createView(),
//            'question' => $question->getQuestionText(),
//        ]);

//        foreach ($data as $key => $value) {
//            $score = $value;
//        }

        $questions = $em->getRepository(Question::class)->findAll();
        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    #[Route('/quiz/submit', name: 'quiz_submit', methods: ['POST'])]
    public function submit(Request $request, EntityManagerInterface $em): Response
    {
        $data = $request->request;
        $score = 0;
        foreach ($data as $key => $value) {
            $string = $key;
            $parts = explode('_', $string);
            $number = (int)$parts[1];

            /** @var Question $realQuestion **/
            $realQuestion = $em->getRepository(Question::class)->findOneBy(['id' => $number]);
            $correctAnswer = $realQuestion->getCorrectAnswer();

            if ($correctAnswer === $value) {
                $score += 10;
            }else {
                $score -= 5;
            }
            $score <= 0 ? $score = 0 : $score;
        }

        return $this->redirectToRoute('quiz_result', [
            'score' => $score,
        ]);
    }

    #[Route('/quiz/result', name: 'quiz_result')]
    public function result(Request $request): Response
    {
        $score = 0;
        $data = $request->query->all();
        foreach ($data as $key => $value) {
            $score = $value;
        }

        return $this->render('quiz/result.html.twig', [
            'score' => $score,
        ]);
    }
}
