<?php

namespace Hadefication\Emailia\Commands;

use Illuminate\Console\Command;

class EmailiaCommand extends Command
{
    public $signature = 'emailia';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
