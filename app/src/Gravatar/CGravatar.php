<?php

// Class CGravatar, generation of avatars based on email address
//
// This class provides capabilities to generate gravatars to
// a website. It wraps the http:/gravatar.com/avatar HTTP API
// and generates an avatar based on an e-mail address. 
//
// Revision history:
// 2014-10-06, herb - First version
//

namespace Herb13\Gravatar;


class CGravatar
{


	// The URL API towards gravatar

	const GRAVATAR_API = "http://www.gravatar.com/avatar.php/";


	// The configuration for avatar generation
	// initialised to its default values

	private $configuration = array(

			'generationId'    => NULL,
			'size'            => 80,
			'styleAttributes' => array(),
		);	


	/************************************************************************** 
	 * Method for returning the URL to a generated gravatar. The generation is
	 * done based on the e-mail address set in setEmail() method
	 * @param -
	 * @return a string with the URL to the gravatar
	 */

	public function getGravatarAsUrl() {

		return self::GRAVATAR_API . $this->configuration['generationId'] . ".jpg?s=" . 
			$this->configuration['size'];
	}


	/************************************************************************** 
	 * Method for returning an <img xxx> tag with generated gravatar. The 
	 * generation is done based on the email address set in setEmail() method.
	 * Further, any style attributes can also be set in setStyleAttributes().
	 * @param  -
	 * @return a string with the <img xx> tag to the gravatar and any style
	 *         attributes set in setStyleAttributes()
	 */

	public function getGravatarAsImg() {

		$styleAttributes = $this->configuration['styleAttributes'];

		$html = '<img src="' . $this->getGravatarAsUrl() . '"';
		foreach($styleAttributes as $key => $value) {

			$html .= ' ' . $key .'="' . $value . '"';
		}
		$html .= '/>';

		return $html;
	}


	/************************************************************************** 
	 * Method for setting an email to be used as hash for fetching the gravatar
	 * @param string, email address
	 * @return -
	 */

	public function setEmail($email) {

		$this->configuration['generationId'] = md5(strtolower(trim($email)));
		return $this;
	}


	/************************************************************************** 
	 * Method for setting the size of the gravatar, default size is 80 pixels.
	 * @param $size, a number, unit pixels
	 * @return -
	 */

	public function setSize($size) {

		$this->configuration['size'] = $size;
		return $this;
	}


	/************************************************************************** 
	 * Method for setting style attributes to be inserted in the <img> tag. 
	 * Tthe style attributes are used when generating a gravatar with the
	 * getGracatarAsImg() method.
	 * @param $attributes, array('a1' => 'v1', 'a2' => 'v2')
	 *        This will produce <img src='<gravatarUrl>' a1='v1' a2='v2'>   
	 * @return -
	 */

	public function setStyleAttributes($attributes) {

		$this->configuration['styleAttributes'] = $attributes;
		return $this;
	}
}