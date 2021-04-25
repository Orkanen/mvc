<?php

declare(strict_types=1);

namespace Fian\Functions;

use PHPUnit\Framework\TestCase;
use Fian\Dice\Dice;
use Fian\Dice\DiceHand;
use Fian\Dice\DiceGraphic;
use Fian\Dice\Rounds;

/**
 * Test cases for the functions in src/functions.php.
 */
class FunctionsTest extends TestCase
{
    /**
     * Test the function getRoutePath().
     */
    public function testGetRoutePath()
    {
        $res = getRoutePath();
        $this->assertEmpty($res);
    }



    /**
     * Test the function renderView().
     */
    public function testRenderView()
    {
        $res = renderView("standard.php");
        $this->assertIsString($res);
    }



    /**
     * Test the function renderView().
     */
    public function testRenderTwigView()
    {
        $res = renderTwigView("index.html");
        $this->assertIsString($res);
    }



    /**
     * Test the function url().
     */
    public function testUrl()
    {
        $res = url("/");
        $this->assertIsString($res);
    }



    /**
     * Test the function getBaseUrl().
     */
    public function testGetBaseUrl()
    {
        $res = getBaseUrl();
        $this->assertIsString($res);
    }



    /**
     * Test the function getCurrentUrl().
     */
    public function testGetCurrentUrl()
    {
        $res = getCurrentUrl();
        $this->assertIsString($res);
    }



    /**
     * Test the function destroySession().
     * @runInSeparateProcess
     */
    public function testDestroySession()
    {
        session_start();

        $_SESSION = [
            "key" => "value"
        ];

        destroySession();
        $this->assertEmpty($_SESSION);
    }

    public function testHappySession()
    {
        $_SESSION["currentRoll"] = 0;

        happySession("dice1");
        $this->assertGreaterThan(0, $_SESSION["currentRoll"]);

        $_SESSION["currentRoll"] = 0;

        happySession("dice2");
        $this->assertGreaterThan(0, $_SESSION["currentRoll"]);

        $_SESSION["currentRoll"] = 0;

        happySession("dice1");
        while ($_SESSION["currentRoll"] <= 18) {
            happySession("dice1");
        };
        happySession("stop");

        if ($_SESSION["status"] == "You Won!") {
            $result = "You Won!";
        } else {
            $result = "Computer Won!";
        }

        $this->assertEquals($result, $_SESSION["status"]);

        happySession("dice1");
        happySession("stop");

        $this->assertEquals("Computer Won!", $_SESSION["status"]);
        $this->assertGreaterThan(0, $_SESSION["compWin"]);

        $_SESSION["currentRoll"] = 22;
        happySession("dice1");

        $this->assertEquals("You Lost!", $_SESSION["status"]);
        $this->assertGreaterThan(0, $_SESSION["compWin"]);

        $_SESSION["currentRoll"] = 22;
        happySession("dice2");

        $this->assertEquals("You Lost!", $_SESSION["status"]);
        $this->assertGreaterThan(0, $_SESSION["compWin"]);

        $_SESSION["currentRoll"] = 21;
        happySession("stop");

        $this->assertEquals("You Won!", $_SESSION["status"]);
        $this->assertGreaterThan(0, $_SESSION["manWin"]);
        $this->assertGreaterThanOrEqual(21, $_SESSION["roboSum"]);
        $this->assertEquals(0, $_SESSION["currentRoll"]);

        $_SESSION["currentRoll"] = 21;
        happySession("dice1");
        $this->assertEquals("You Won!", $_SESSION["status"]);
        $this->assertGreaterThan(0, $_SESSION["manWin"]);
        $this->assertEquals(0, $_SESSION["currentRoll"]);


        $_SESSION["currentRoll"] = 21;
        happySession("dice2");
        $this->assertEquals("You Won!", $_SESSION["status"]);
        $this->assertGreaterThan(0, $_SESSION["manWin"]);
        $this->assertEquals(0, $_SESSION["currentRoll"]);
    }

    public function testObjectCreator()
    {
        objectCreator();
        $result1 = unserialize($_SESSION['die']);
        $result2 = unserialize($_SESSION['dice']);
        $result3 = unserialize($_SESSION['diceHand']);
        $result4 = unserialize($_SESSION['rounds']);

        $this->assertIsObject($result1);
        $this->assertIsObject($result2);
        $this->assertIsObject($result3);
        $this->assertIsObject($result4);
    }

    public function testYatzy()
    {
        objectCreator();
        yatzy("roll");
        //yatzy();
        $result1 = $_SESSION["testing"];
        $this->assertIsString($result1);

        yatzy("none", [null, 1, null, 3, null]);
        $result1 = $_SESSION["testing2"];
        $this->assertIsString($result1);
    }

    public function testGameOver()
    {
        objectCreator();
        $result1 = gameOver();

        $this->assertEquals(1, $result1);
    }

    public function testDice()
    {
        $dice = new Dice();

        $this->assertIsObject($dice);

        $dice->setFaces(3);

        $this->assertEquals(3, $dice->getFaces());
    }

    public function testDiceHand()
    {
        $dice = new Dice();
        $diceHand = new DiceHand(3);

        $this->assertIsObject($diceHand);

        $diceHand->roll();

        $this->assertIsString($diceHand->getLastRoll());
    }

    public function testRounds()
    {
        $rounds = new Rounds();
        $test1 = $rounds->roboSum();
        $rounds->roboRoll();
        $test2 = $rounds->roboSum();

        $this->assertGreaterThan($test1, $test2);
        $rounds->addRoundHand("<i class=dice1></i>");
        $this->assertIsString($rounds->getRoundHand());

        $curSum = $rounds->roboSum();
        $rounds->curRoll(20);
        $curSum2 = $rounds->roboSum();
        $this->assertGreaterThan($curSum, $curSum2);
    }
}
