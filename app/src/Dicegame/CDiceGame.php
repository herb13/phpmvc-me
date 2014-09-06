<?php

// Class CDiceGame, manages the game of 100
//
// This class contains the game logic and the HTML generation for the game
// The class uses $_POST for handling user interaction and $_SESSION for
// saving and retrieving game standing and statistics.
//
// What does the class do?
// Dice game 100. A player throws a dice as many times it wants and the result  
// is accumulated each throw. At any time the player may collect the result, but if
// the player gets 1 - zero point is awarded in the round and a new round starts
//
// Restrictions: If you have multiple instances of this class they will all
// read/write from the same session. 
//
// Future improvements: Move HTML generation to an own class. 
// Append an uniqueId, supplied in the constructor, to save and retrieve data in
// session. This will allow multiple simultaneous instances of this class which
// is a pre-requisite for multi-player
//
// Revision history:
// 2014-02-28, herb - First version
// 2014-09-01, herb - Added support for namespace
//                    Added session as input to constructor
//                    Added game instruction function
//

namespace Herb13\Dicegame;

use \Herb13\Dicegame\CDiceHand;
use \Anax\Session\CSession;

class CDiceGame
{
	
	// Class members
	
	// Constants
	const DICE_FACES      = 6;    // faces on the dice
	const NUM_DICE        = 1;    // default number of dice
	const UNWANTED_NUMBER = 1;    // number to avoid
	const FINISH_POINTS   = 100;  // total points when game is finished 
	
	// Game standing
	private $diceHand;        // hand of dice
	private $totalPoints;     // total points in the game
	private $roundPoints;     // points for an ongoing round
	
	// Statistics
	private $totalNumOfRolls; // total number of rolls since start of game
	private $bestRound;       // round with most points
	
	// Game state
	private $newRound;        // a new round, first roll in round
	private $forceNewGame;    // a new game must be started after a finished one
	
	// User output
	private $gameStatistics;  // game statistics output to user

	// The session to save game data
	private $session;
	
	/****************************************************************************
	 * Constructor, create a hand of dice and fetch any available data 
	 * from $_SESSION if it exists.
	 * @param -
	 * @return optional integer for the number of dice (default is NUM_DICE) 
	 */

	public function __construct(CSession $session, $numDice = self::NUM_DICE)
	{	
		$this->diceHand = new CDiceHand($numDice,self::DICE_FACES); // create a hand of dice
		$this->gameStatistics = array();  // reset statistics
		
		// Read back game standing from the session. Updated standing is 
		// saved in the session in the destructor. It's enough to check
		// that totalPoints is set. Then also the rest will be set.

		if($session->has('totalPoints')) {

			$this->totalPoints     = $session->get('totalPoints');
			$this->roundPoints     = $session->get('roundPoints');
			$this->totalNumOfRolls = $session->get('totalNumOfRolls');
			$this->bestRound       = $session->get('bestRound');
		}

		// Nothing set in $_SESSION. Reset the game state

		else { 
		
			$this->totalPoints     = 0;
			$this->roundPoints     = 0;
			$this->totalNumOfRolls = 0;
			$this->bestRound       = 0;
		}

		// Save session so that it can be used in destructor
		$this->session = $session;
	}
	
	/****************************************************************************
	 * Destructor, store latest game data into $_SESSION
	 * @param -
	 * @return -
	 */
	
	public function __destruct()
	{
		// Save game standing for next round of game in session. It will be
		// read back in the constructor
		$this->session->set('totalPoints', $this->totalPoints);
		$this->session->set('roundPoints', $this->roundPoints);
		$this->session->set('totalNumOfRolls', $this->totalNumOfRolls);
		$this->session->set('bestRound', $this->bestRound);
	}
	
	/****************************************************************************
	 * Returns instructions for the game
	 * @param -
	 * @return HTML with game instructions
	 */

	public function getGameInstruction()
	{
		return "<h1>Tärningsspelet 100</h1>
			<p>Tärningspelet 100 går ut på att kasta tärning och komma till 100 poäng. Varje nytt kast adderas till det
			föregående. Men, slår du en etta så nollas poängen för den pågående rundan. Du kan spara dina poäng från 
			pågående runda genom att klicka på 'spara runda'. Då adderas poängen för rundan till din total poäng och är säkrad.</p>";
	}

	/****************************************************************************
	 * Creates the game panel for a player
	 * @param $_POST is used for retriveing user action 
	 * @return string with HTML for the game panel
	 */
	
	public function getGamePanel()
	{	
		$html = array();
		$html['diceFaces'] = null;
		
		if(isset($_POST['roll'])) {

			$this->roll();
			$html['diceFaces'] = $this->getDiceFacesAsHtml($this->diceHand->getResultAsArray());
		}
		elseif(isset($_POST['collect'])) {

			$this->collect();
		}
		else { // Nothing set in $_POST or $_POST['newGame'] Start from beginning 
		
			$this->newGame();
		}
		
		// create game panel
		$html['gameResult'] = $this->getGameResultsAsHtml();
		$html['playerOption'] = $this->getPlayerOptionsAsHtml();
		
		return $html['gameResult'] . $html['playerOption'] . $html['diceFaces'] . 
			$this->getGameStatisticsAsHtml();
	}
	
	// Below are private methods for this class. 
	// The methods are used for updating game state and handle
	// the different user actions.
	//
	
	/****************************************************************************
	 * Rolls the dice and update state of the game. Check if user got a one
	 * @param -
	 * @return updates the class members roundPoints, totalNumOfRolls, newRound
	 *         diceHand
	 */ 
	 
	private function roll()
	{
		$this->diceHand->roll();
		$this->totalNumOfRolls++;
		
		if($this->diceHand->contains(self::UNWANTED_NUMBER)) {

			// Result contains the magic number. End of this round
			$this->roundPoints = 0;
			$this->newRound = true;
		}
		else {

			// No magic number, accumulate round points and continue round
			$this->roundPoints += $this->diceHand->getSum();
			$this->newRound = false;
		}
	}
	
	/****************************************************************************
	 * Collect points for current round. Checks if game is finished
	 * @param -
	 * @return updates the class members roundPoints, totalPointss, newRound
	 *         gameStatistics
	 */
	
	private function collect()
	{
		$this->totalPoints += $this->roundPoints;
		
		// Update statistics
		if($this->bestRound < $this->roundPoints) {

			$this->bestRound = $this->roundPoints;
		}
		
		$this->roundPoints = 0;
		$this->newRound = true;
		
		// Check if game is finished (total points reached desired value)
		if($this->totalPoints >= self::FINISH_POINTS) {

			$this->gameStatistics[] = "Grattis du klarade spelet! Du fick ihop " . $this->totalPoints . " poäng!";
			$this->gameStatistics[] = "Antal kast: " . $this->totalNumOfRolls;  
			$this->gameStatistics[] = "Bästa rundan: " . $this->bestRound . " poäng";
			
			// Force player to start a new game
			$this->forceNewGame = true;
		}

	}
	
	/****************************************************************************
	 * Starts a new game. Initialises game variables
	 * @param -
	 * @return resets the class members roundPoints, totalPointss, newRound
	 *         forceNewGame, bestRound, totalNumOfRolls
	 */
	
	private function newGame()
	{
		$this->newRound = true;
		$this->forceNewGame = false;
		$this->totalPoints = 0;
		$this->roundPoints = 0;
		$this->totalNumOfRolls = 0;
		$this->bestRound = 0;
	}
	
	// Below are private methods for HTML generation for the game. 
	// The methods are used for updating game state and handle
	// the different user actions.
	//
	
	/****************************************************************************
	 * Generates HTML for the result of a roll.
	 * @param array of integers $result
	 * @return string $html for the dice's face  
	 */
	
	private function getDiceFacesAsHtml($result)
	{
		$html = "<ul class='dice'>";
		foreach($result as $val) {

			$html .= "<li class='dice-{$val}'></li>"; 
		}
		$html .= "</ul>"; 
		
		return $html;
	}
	
	/****************************************************************************
	 * Generates HTML for current game standing
	 * @param - 
	 * @return string $html with current standing
	 */
	
	private function getGameResultsAsHtml()
	{
		$html = "<hr>";
		$html .= "<p class='notice'>Totalpoäng: " . $this->totalPoints . "</p>";
		$html .= "<p class='info'>Poäng pågånde runda: " . $this->roundPoints . "</p>";
		return $html;
	}
	
	/****************************************************************************
	 * Generates HTML for player's options
	 * @param - 
	 * @return string $html with a post method with options as buttons
	 */
	
	private function getPlayerOptionsAsHtml() 
	{
		$rollDisabled = null;
		$collectDisabled = null;
		
		if($this->newRound == true) {

			$collectDisabled = "disabled";
		}
		
		if($this->forceNewGame == true) {

			$collectDisabled = "disabled";
			$rollDisabled = "disabled";
		}
		
		// Post 
	 	$html= <<<EOD
	 	<form method="post">
    	<p>
     		<input type="submit" value="Kasta!" name="roll" $rollDisabled>
      	<input type="submit" value="Spara runda" name="collect" $collectDisabled>
      	<input type="submit" value="Nytt spel" name="new_game">
      </p>   
    </form>
    <hr>
EOD;
		return $html;
	}
		
	/****************************************************************************
	 * Generates HTML for game statistics
	 * @param - 
	 * @return string $html which contains game statistics
	 */
	
	private function getGameStatisticsAsHtml()
	{
		$html = null;
		if($this->gameStatistics != null) {

			$html .= "<p class='success'>";
			foreach($this->gameStatistics as $val) {
				
				$html .= $val . "</br>";
			}
			$html .= "</p>";
		}
		
		return $html;
	}
	
} // End of class

