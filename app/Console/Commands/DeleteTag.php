<?php
// cronjob
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;

class DeleteTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Tag bY id';

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
        $id = $this->argument('id');
        $tag = Tag::find($id);

        if (!$tag) {
            $this->error('Tag không tồn tại');
            return;
        }

        $isDelete = $this->confirm('Bạn có muốn xóa tag: ' . $tag->name);
        if ($isDelete) {

            $isDeletePost = $this->confirm('Bạn có muốn bài viết của tag này hay không');
            if ($isDeletePost) {
                $totalDeletePost = (int) $this->ask('Bạn muốn xóa bao nhiêu bài');
                $posts = $tag->posts()->limit($totalDeletePost)->get();
                foreach ($posts as $post) {
                    $post->delete();
                }
            }
            $tag->delete();
            $this->info('Đã xóa');
        }

    }
}
