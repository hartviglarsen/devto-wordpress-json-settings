<?php

$html_options = '';
				
foreach ($args['options'] as $key => $val) {
    $html_options .= sprintf('<option value="%s" %s >%s</option>', $key, selected($args['value'], $key, false), $val);
}

printf('<select name="%s" id="%s">%s</select>', $args['id'], $args['id'], $html_options);
