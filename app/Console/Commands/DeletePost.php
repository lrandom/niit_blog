<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\Post;

class DeletePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = $this->argument('from');
        $to = $this->argument('to');
        $posts = Post::where('id', '>=', $from)->where('id', '<=', $to)->get();
        $bar = $this->output->createProgressBar($posts->count());

        $bar->start();

        foreach ($posts as $post) {
            sleep(2);
            $post->delete();
            $bar->advance();
        }

        $bar->finish();
    }
}
