<?php

// Class CDice, a dice
//
// This class describes a dice with a selectable number of faces.
// It keeps track of what face is up (1 to numFaces). 
//
// Revision history:
// 2014-02-22, herb - First version
// 2014-09-01, herb - Added support for namespace
//

namespace Herb13\Dicegame;

class CDice
{
	
	// Members
	private $numFaces;   // type of dice
	private $latestRoll; // latest result
	
	/************************************************************************** 
	 * Constructor 
	 * @param integer $theNumFaces
	 * @return -
	 */
	
	public function __construct($theNumFaces)
	{
		// Save number of faces for later rolls
		$this->numFaces = $theNumFaces;
		
		// Initialise the dice to a random value
		$this->roll();
	}
	
	/************************************************************************** 
	 * Roll the dice, updates the state of the dice (state generated randomly) 
	 * @param -
	 * @return - 
	 */
	
	public function roll()
	{
		// Roll the dice, random value between 1 and number of faces
		$this->latestRoll = rand(1, $this->numFaces);
	}
	
	/************************************************************************** 
	 * Getter for the state of the dice (latest roll) 
	 * @param -
	 * @return integer between 1 and numFaces 
	 */
	
	public function getResult() 
	{
		// Resturn the last result
		return $this->latestRoll;
	}
	
	/************************************************************************** 
	 * Getter for the number of faces. A property of the dice 
	 * @param -
	 * @return integer. Same value as supplied in constructor 
	 */
	
	public function getFaces()
	{
		return $this->numFaces;
	}
	
}
