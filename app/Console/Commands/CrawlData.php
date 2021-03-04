<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Post;

class CrawlData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl Data';

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
        $client = new Client();
        for($i = 1; $i <= 1000; $i++) {
            $url = 'https://vnexpress.net/kinh-doanh/bat-dong-san-p' . $i;

            $crawler = $client->request('GET', $url);
            $crawler->filter('.item-news .thumb-art a')->each(function ($node) {
                $url = $node->attr('href');
                $this->crawlDetail($url);
            });
        }
    }

    public function crawlDetail($url)
    {
        try {
            $client = new Client();
            $crawler = $client->request('GET', $url);
            $title = $crawler->filter('.title-detail')->first()->text();
            $description = $crawler->filter('.description')->first()->text();
            $post = new Post;
            $post->title = $title;
            $post->slug = \Str::slug($title);
            $post->description = $description;
            $post->content = $description;
            $post->save();
            $this->info('Crawl tin thành công: ' . $title);

        } catch (\Exception $e) {

        }
    }
}
