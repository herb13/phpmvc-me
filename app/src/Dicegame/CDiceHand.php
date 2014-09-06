<?php

// Class CDiceHand, a hand of dice
//
// This class describes a hand with a selectable number of dice. Each dice
// in the hand have the same number of faces, wich is a selectable property
// of the dice. The class keeps track of the state of what faces is up for
// each dice (state of the hand).
//
// Revision history:
// 2014-02-23, herb - First version
// 2014-09-01, herb - Added support for namespace
//

namespace Herb13\Dicegame;

use \Herb13\Dicegame\CDice;

class CDiceHand 
{
	
	// Class members
	private $handOfDice;					  // array with a number of dice
	
  /************************************************************************** 
   * Constructor 
   * @param integer $theNumDice $theNumFaces
   * @return -
   */
	
	public function __construct($theNumDice, $theNumFaces)
	{	
		// Save number of dices for later rolls
		for($i = 0; $i < $theNumDice; $i++) {

			$this->handOfDice[] = new CDice($theNumFaces);	
		}
	}
	
	/************************************************************************** 
	 * Roll the hand of dice, updates the state of each dice in the hand 
	 * @param -
	 * @return -
	 */
	
	public function roll() 
	{
		// Roll the dices
		foreach($this->handOfDice as $dice) {

			$dice->roll();
		}
	}
	
	/************************************************************************** 
	 * Getter for the sum of the hand, a property of the hand of dice 
	 * @param -
	 * @return integer, the sum of latest roll
	 */
	
	public function getSum()
	{
		return array_sum($this->getResultAsArray());
	}
	
	/************************************************************************** 
	 * Getter for the sum of all dice in the hand 
	 * @param -
	 * @return array with integers, size of array is equal to $theNumDice
	 */
	
	public function getResultAsArray()
	{
		// Fetch reult from the dice
		$latestRoll = array();
		foreach($this->handOfDice as $dice) {

			$latestRoll[] = $dice->getResult();
		}
		
		return $latestRoll;
	}
	
	/************************************************************************** 
	 * Check if the hand of dice contains a specific value 
	 * @param integer $value, number to search for
	 * @return bool, true if value exists, false if not found
	 */
	
	public function contains($value)
	{
		foreach($this->handOfDice as $dice)  {
			
			if($dice->getResult() == $value) {return true;}
		}
		
		return false;
	}

}
