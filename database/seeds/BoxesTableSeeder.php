<?php


use App\Box;
use App\Comment;
use App\Tag;
use App\Box_tag;
use Illuminate\Database\Seeder;

class BoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Box::create([
            'id' => 1,
            'place_name' => 'ユニクロ',
            'message' => '営業時間注意',
            'url' => 'https://map.uniqlo.com/jp/ja/detail/10101307',
            'address' => '東京都渋谷区道玄坂２丁目２９−５ 内 渋谷プライム',
            'box_latitude' => '35.6594202',
            'box_longitude' => '139.6983425',
            'u_id' => 1,
        ]);
        
        Comment::create([
            'id' => 1,
            'comment' => '素晴らしい教訓。プロになる道が開かれた。',
            'u_id' => '1',
            'box_id' => '1',
        ]);
        
        Tag::create([
            'id' => 1,
            'tag_name' => '自社製品',
        ]);
        
        Box_tag::create([
            'id' => 1,
            'box_id' => 1,
            'tag_id' => 1,
        ]);
        
    }
}
