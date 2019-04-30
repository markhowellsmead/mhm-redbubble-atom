<?php

namespace MarkHowellsMead\RedbubbleAtom;

class Plugin
{
	public $url = '';

	public function __construct()
	{
		$options = new Options();
		$this->url = $options->get('url');

		add_shortcode('redbubble', function ($atts) {
			if (!empty($this->url)) {
				$parser = new AtomParser($this->url);
				return $parser->getFrom($this->url);
			}
		});
	}
}
