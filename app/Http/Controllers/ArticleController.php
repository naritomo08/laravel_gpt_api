<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Inertia\Inertia;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index()
    {
        return Inertia::render('Article/Index');
    }

    public function list(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $gpt_keywords = $this->getKeywordsByChatGpt($keyword);
        $articles = [];

        if(count($gpt_keywords) > 0) {

            $articles = Article::query()
                ->when($gpt_keywords, function ($query, $gpt_keywords) {

                    foreach ($gpt_keywords as $gpt_keyword) {

                        $query->orWhere('title', 'LIKE', "%{$gpt_keyword}%")
                            ->orWhere('content', 'LIKE', "%{$gpt_keyword}%");

                    }

                })
                ->get();

        }

        return [
            'gpt_keywords' => $gpt_keywords,
            'articles' => $articles,
        ];
    }

    private function getKeywordsByChatGpt(string $keyword): array
    {
        $keyword = mb_convert_kana($keyword, 's', 'UTF-8');
        $keywords = collect(explode(' ', $keyword))
            ->filter(function ($keyword) {

                return Str::length($keyword) > 0; // 空文字を除外

            })
            ->map(function ($keyword) {

                return '・'. $keyword;

            });

        if($keywords->count() === 0) {

            return [];

        }

        $target_keyword_content = $keywords->implode("\n");

        $prompt =
<<<TEXT
あなたは優秀なコピーライターとして回答してください。
以下の「対象キーワード」に関連するキーワードを挙げてください

# 対象キーワード
{$target_keyword_content}

なお、条件は以下のとおりです。

・回答はキーワードのみで「,」で区切る
TEXT;

        $cache_key = md5($target_keyword_content);

        return Cache::rememberForever($cache_key, function () use($prompt) {

            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);
            $gpt_keyword = Arr::get($result, 'choices.0.message.content');

            return explode(',',
                str_replace(' ', '', $gpt_keyword)
            );

        });
    }
}
