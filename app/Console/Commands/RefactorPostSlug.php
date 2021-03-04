<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class RefactorPostSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:refactor';

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
        $posts = Post::whereNull('slug')->get();

        foreach ($posts as $post) {
            $post->slug = \Str::slug($post->title);
            $post->save();
            $this->info('Update: ' . $post->id);
        }
    }
}
