<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // １件だけ追加する
        $article = new Article();
        $article->title = 'フレデリック・ショパン';
        $article->content =
    <<<TEXT
    ポーランド出身の、前期ロマン派音楽を代表する作曲家。当時のヨーロッパにおいても＊＊＊＊＊として、また作曲家としても有名だった。その作曲のほとんどを＊＊＊独奏曲が占め、＊＊＊の詩人[注 4]とも呼ばれるようになった。様々な形式・美しい旋律・半音階的和声法などによって＊＊＊の表現様式を拡大し、＊＊＊音楽の新しい地平を切り開いていった。夜想曲やワルツなど、今日でも彼の作曲した＊＊＊曲はクラシック音楽ファン以外にもよく知られており、＊＊＊の演奏会において取り上げられることが多い作曲家の一人である。また、強いポーランドへの愛国心からフランスの作曲家としての側面が強調されることは少ないが、父の出身地で主要な活躍地だった同国の音楽史に占める重要性も無視できない。
    1988年からポーランドで発行されていた5,000ズウォティ紙幣に肖像が使用されていた。また、2010年にもショパンの肖像を使用した20ズウォティの記念紙幣が発行されている。2001年、ポーランド最大の空港「オケンチェ空港（Port lotniczy Warszawa-Okęcie）」が「ワルシャワ・ショパン空港」に改名された。
    TEXT;

        $article->save();
    }
}
