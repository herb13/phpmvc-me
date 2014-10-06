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

	private $configuration = array(

			'generationId'    => NULL,
			'size'            => 80,
			'styleAttributes' => array(),
		);	


	/************************************************************************** 
	 * 
	 * @param 
	 * @return -
	 */

	public function getGravatarAsUrl() {

		return self::GRAVATAR_API . $this->configuration['generationId'] . ".jpg?s=" . 
			$this->configuration['size'];
	}


	/************************************************************************** 
	 * 
	 * @param 
	 * @return -
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
	 * 
	 * @param 
	 * @return -
	 */

	public function setEmail($email) {

		$this->configuration['generationId'] = md5(strtolower(trim($email)));
		return $this;
	}

	/************************************************************************** 
	 * 
	 * @param 
	 * @return -
	 */

	public function setSize($size) {

		$this->configuration['size'] = $size;
		return $this;
	}

	/************************************************************************** 
	 * 
	 * @param 
	 * @return -
	 */

	public function setStyleAttributes($attributes) {

		$this->configuration['styleAttributes'] = $attributes;
		return $this;
	}
}