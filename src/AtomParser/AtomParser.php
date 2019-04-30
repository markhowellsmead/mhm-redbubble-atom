<?php

namespace MarkHowellsMead;

use SimpleXMLElement;
use stdClass;

class AtomParser
{

	public function getFrom($url)
	{

		$feed = file_get_contents($url);
		$xml  = new SimpleXMLElement($feed);

		$entries = [];

		foreach ($xml->entry as $xml_entry) {
			$xml_entry                                       = (array) $xml_entry;
			$entries[ strtotime($xml_entry['published']) ] = new stdClass();
			$entries[ strtotime($xml_entry['published']) ]->title      = $xml_entry['title'];
			$entries[ strtotime($xml_entry['published']) ]->content    = $xml_entry['content'];
			$entries[ strtotime($xml_entry['published']) ]->categories = [];

			if (! empty($xml_entry['category'])) {
				foreach ($xml_entry['category'] as $category) {
					$entries[ strtotime($xml_entry['published']) ]->categories[] = $category['term'];
				}
			}
		}

		// Reverse sort (Z-A) by publication date
		krsort($entries);

		$html = '';

		$html .= '<div class="c-redbubble__entries">';
		foreach ($entries as $key => $entry) {
			$entry->content = str_replace(',black,', ',natural,', $entry->content);
			$entry->content = preg_replace('~([0-9]{3})x([0-9]{3})~', '800x600', $entry->content);
			$html          .= sprintf(
				'<div class="c-redbubble__entry">%1$s%2$s%3$s</div>',
				$entry->content,
				empty($entry->categories) ? '' : sprintf(
					'<p class="c-redbubble__categories">%1$s: %2$s</p>',
					_x('Keywords', '', 'mhm-redbubble'),
					implode(', ', $entry->categories)
				),
				sprintf(
					'<time class="c-redbubble__published" date="%1$s">%2$s: %3$s',
					$key,
					_x('Published', '', 'mhm-redbubble'),
					date_i18n('jS F Y', $key)
				)
			);
		}

		$html .= '</div>';

		return $html;
	}
}
