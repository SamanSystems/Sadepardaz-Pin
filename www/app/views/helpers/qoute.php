<?php

class QouteHelper extends AppHelper {
    function blockqoute($input)
	{
		return nl2br(str_replace(array('{کد}', '{/کد}'), array('<blockquote class="ticketCode"><div>', '</div></blockquote>'), $input));
	}
}
?>