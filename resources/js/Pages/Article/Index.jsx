import { useState } from "react";
import axios from "axios";

export default function ArticleIndex () {

    const [keyword, setKeyword] = useState("");
    const [articles, setArticles] = useState([]);
    const [gptKeywords, setGptKeywords] = useState([]);

    const handleSubmit = () => {

        //const url = route('article.list');
        const url = 'http://127.0.0.1:8080/article/list';
        const params = {
            params: { keyword },
        }

        axios.get(url, params)
            .then((response) => {

                setArticles(response.data.articles);
                setGptKeywords(response.data.gpt_keywords);

            });

    };

    return (
        <div className="container mx-auto px-4 py-8">
            <div className="flex items-center">
                <input
                    type="text"
                    className="w-full p-2 border border-gray-300 rounded mr-2"
                    placeholder="検索キーワード..."
                    value={keyword}
                    onChange={(e) => setKeyword(e.target.value)}
                />
                <button
                    type="button"
                    className="bg-blue-500 text-white py-2 px-4 rounded whitespace-nowrap"
                    onClick={handleSubmit}
                >
                    検索
                </button>
            </div>
            {gptKeywords.length > 0 && (
                <div className="mt-5">
                    <h2 className="text-xl font-bold">GPT-3によるキーワード</h2>
                    {gptKeywords.map((gptKeyword, index) => (
                        <span key={index} className="mb-4">・{gptKeyword} </span>
                    ))}
                </div>
            )}
            {gptKeywords.length > 0 && (
                <div className="mt-5">
                    {articles.map((article, index) => (
                        <div key={index} className="mb-4">
                            <h3 className="text-xl font-bold">{article.title}</h3>
                            <p>{article.content}</p>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );

};
