<?php
class SiteHelpers
{
    public static function alert($task, $message)
    {
        if($task =='error') {
            $alert ='
			<div class="alert alert-danger  fade in block-inner">
				<button data-dismiss="alert" class="close" type="button"> x </button>
			<i class="icon-cancel-circle"></i> '. $message.' </div>
			';
        }
    }
}