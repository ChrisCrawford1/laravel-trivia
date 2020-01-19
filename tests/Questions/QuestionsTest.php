<?php

namespace ChrisCrawford1\LaravelTrivia\Tests\Questions;

use ChrisCrawford1\LaravelTrivia\Entities\LaravelTrivia;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    /**
     * @var MockHandler
     */
    private $mock;

    /**
     * @var HandlerStack
     */
    private $handler;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var \ChrisCrawford1\LaravelTrivia\Client
     */
    private $triviaClient;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"response_code":0,"results":[{"category":"Vehicles","type":"multiple","difficulty":"medium","question":"What part of an automobile engine uses lobes to open and close intake and exhaust valves, and allows an air\/fuel mixture into the engine?","correct_answer":"Camshaft","incorrect_answers":["Piston","Drive shaft","Crankshaft"]},{"category":"History","type":"multiple","difficulty":"medium","question":"America&#039;s Strategic Defense System during the Cold War was nicknamed after this famous movie.","correct_answer":"Star Wars","incorrect_answers":["Jaws","Blade Runner","Alien"]},{"category":"Entertainment: Video Games","type":"multiple","difficulty":"medium","question":"In the game &quot;Undertale&quot;, who was Mettaton&#039;s creator?","correct_answer":"Alphys","incorrect_answers":["Undyne","Sans","Asgore"]},{"category":"Vehicles","type":"multiple","difficulty":"medium","question":"Which of the following is NOT a Russian car manufacturer?","correct_answer":"BYD","incorrect_answers":["Silant","Dragon","GAZ"]},{"category":"Entertainment: Board Games","type":"multiple","difficulty":"medium","question":"The board game, Nightmare was released in what year?","correct_answer":"1991","incorrect_answers":["1992","1989","1995"]},{"category":"History","type":"boolean","difficulty":"medium","question":"In 1967, a magazine published a story about extracting hallucinogenic chemicals from bananas to raise moral questions about banning drugs.","correct_answer":"True","incorrect_answers":["False"]},{"category":"Science: Computers","type":"multiple","difficulty":"medium","question":"What is the correct term for the metal object in between the CPU and the CPU fan within a computer system?","correct_answer":"Heat Sink","incorrect_answers":["CPU Vent","Temperature Decipator","Heat Vent"]},{"category":"Science & Nature","type":"multiple","difficulty":"medium","question":"Approximately how long is a year on Uranus?","correct_answer":"84 Earth years","incorrect_answers":["47 Earth years","62 Earth years","109 Earth years"]},{"category":"Sports","type":"multiple","difficulty":"medium","question":"Which NBA player won Most Valuable Player for the 1999-2000 season?","correct_answer":"Shaquille O&#039;Neal","incorrect_answers":["Allen Iverson","Kobe Bryant","Paul Pierce"]},{"category":"Animals","type":"multiple","difficulty":"medium","question":"What is the name for a male bee that comes from an unfertilized egg?","correct_answer":"Drone","incorrect_answers":["Soldier","Worker","Male"]}]}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
        $this->triviaClient = new \ChrisCrawford1\LaravelTrivia\Client($this->client);
    }

    /** @test */
    public function it_can_retrieve_a_list_of_10_questions()
    {
        $questions = new LaravelTrivia($this->triviaClient);
        $response = $questions->get();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(2, $response);
        $this->assertEquals($questions->getNoOfQuestions(), count(json_decode($response, true)['results']));
    }

    /** @test */
    public function it_will_set_a_default_of_10_for_questions_quantity()
    {
        $questions = new LaravelTrivia($this->triviaClient);
        $this->assertEquals(10, $questions->getNoOfQuestions());
    }

    /** @test */
    public function it_will_set_a_default_of_medium_for_question_difficulty()
    {
        $questions = new LaravelTrivia($this->triviaClient);
        $this->assertEquals('medium', $questions->getDifficulty());
    }
}
