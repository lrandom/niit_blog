<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// php artisan make:command AddWebsitePost
// php artisan migrate:refresh
class InitWebsiteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // php artisan website:init
    protected $signature = 'website:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Khởi tạo dữ liệu website';

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
        $this->info('This text is info');
        $this->initUser();
        $this->initProfile();
        $this->initCategory();
        $this->initTags();
        $this->initPosts();
    }

    public function initUser()
    {
        $this->info('call initUser');
        $user =  new \App\Models\User;
        $user->name = 'Nguyễn Thị A';
        $user->email = 'ant@topcv.vn';
        $user->gender = 2;
        $user->password = bcrypt('123456789');
        $user->save();
    }

    public function initProfile()
    {
        $this->info('call initProfile');
        $profile =  new \App\Models\Profile;

        $profile->id_code = '12341231234';
        $profile->address = 'Ha Noi';
        $profile->gender = 1;
        $profile->user_id = 1;

        $profile->save();
    }

    public function initCategory()
    {
        $this->info('call initCategory');
        $categories = [
            'Pháp luật',
            'Thể thao',
            'Teen',
        ];

        foreach ($categories as $category) {
            $cate = new \App\Models\Category;
            $cate->name = $category;
            $cate->description = $category;
            $cate->save();
        }

    }

    public function initTags()
    {
        $this->info('call initTags');
        $tag = new \App\Models\Tag;
        $tag->name = 'covid';
        $tag->save();


        $tag = new \App\Models\Tag;
        $tag->name = 'kinh doanh';
        $tag->save();


        $tag = new \App\Models\Tag;
        $tag->name = 'MMA';
        $tag->save();
    }

    public function initPosts()
    {
        $this->info('call initPosts');
        for ($i=0; $i < 122; $i++) {
            $post = new \App\Models\Post;
            $post->title = 'Nóng nhất thể thao tối 9/1: Mayweather lại "cà khịa" Pacquiao là ông già';
            $post->description = 'Nóng nhất thể thao tối 9/1: Mayweather lại "cà khịa" Pacquiao là ông già';
            $post->content = 'Nóng nhất thể thao tối 9/1: Mayweather lại "cà khịa" Pacquiao là ông già';
            $post->save();
        }
    }

}
