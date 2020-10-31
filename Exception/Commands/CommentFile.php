<?php

namespace Codenom\Framework\Exception\Commands;

use CodeIgniter\I18n\Time;

class CommentFile
{
    public static function addCommnetOnFilePhp()
    {
        $comment = '
/**
 * Create Module via CLI
 * Version: 1.0
 * 
 * Created at: ' . new Time('now') . '
 * 
 * HAPPY CODING
 */
    ';

        return $comment;
    }
}
