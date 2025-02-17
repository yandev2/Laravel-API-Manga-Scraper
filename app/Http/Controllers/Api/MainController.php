<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArrayResoruce;
use Illuminate\Http\Request;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class MainController extends Controller
{
    public function popular()
    {
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', 'https://komikindo2.com/');
        $data = $crawler->filter('.post-show.mangapopuler .odadingslider .animposx');

        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->children('a')->attr('href')),
                'img' => $v->filter('.limit')->children('img')->count() > 0
                    ? $v->filter('.limit')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'jenis' => $v->filter('.warnalabel')->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),
                'chapter' => $v->filter('.lsch')->text(),
                'last_update' => $v->filter('.datech')->text(),
            ];
        });
        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        return new ArrayResoruce(true, '', $result);
    }

    public function terbaru()
    {
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', 'https://komikindo2.com/');
        $data = $crawler->filter('.post-show.chapterbaru .animposx');

        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->filter('.animepostxx-top')->children('a')->attr('href')),
                'img' => $v->filter('.limietles')->children('img')->count() > 0
                    ? $v->filter('.limietles')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'ratting' => $v->filter('.flex-skroep.nginfo-skroep')->eq(0)->text(),
                'jenis' => $v->filter('.flex-skroep.nginfo-skroep')->eq(3)->text(),
                'view' => $v->filter('.flex-skroep.nginfo-skroep')->eq(2)->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),
                'status' => $v->filter('.animepostxx-bottom .flex-skroep.nginfo-skroep')->eq(0)->text(),
                'chapter' => $v->filter('.animepostxx-bottom .flex-skroep.nginfo-skroep')->eq(1)->filter('.lsch')->eq(0)->text(),
            ];
        });

        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        return new ArrayResoruce(true, '', $result);
    }


    public function berwarna($page)
    {
        $url = $page == '1' ? 'https://komikindo2.com/komik-berwarna/' : 'https://komikindo2.com/komik-berwarna/page/' . $page;

        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $url);
        $data = $crawler->filter('.widget-body .listupd .animposx');

        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->children('a')->attr('href')),
                'img' => $v->filter('.limit')->children('img')->count() > 0
                    ? $v->filter('.limit')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'chapter' => $v->filter('.lsch')->children('a')->text(),
                'last_update' => $v->filter('.datech')->text(),
                'jenis' => $v->filter('.warnalabel')->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),

            ];
        });
        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        $crawler2 = $browser->request('GET', 'https://komikindo2.com/komik-berwarna/');
        $page = $crawler->filter('.widget-body .pagination');
        $page2 = $crawler2->filter('.widget-body .pagination');

        $response = [
            'current_page' => $page->filter('.page-numbers.current')->text(),
            'total_page' => $page2->filter('.page-numbers')->eq($page2->filter('.page-numbers')->count() - 2)->text(),
            'data' => $result
        ];

        return new ArrayResoruce(true, '', $response);
    }

    public function genre()
    {
        $result = ['Action', 'Adventure', 'Boys-Love', 'Comedy', 'Crime', 'Drama', 'Fantasy', 'Girls-Love', 'Harem', 'Historical', 'Horror', 'Isekai', 'Magical-Girls', 'Mecha', 'Medical', 'Music', 'Mystery', 'Philosophical', 'Psychological', 'Romance', 'Sci-Fi', 'Shoujo-Ai', 'Shounen-Ai', 'Slice-of-Life', 'Sports', 'Superhero', 'Thriller', 'Tragedy', 'Wuxia', 'Yuri'];
        return new ArrayResoruce(true, '', $result);
    }

    public function thema()
    {
        $result = ['Aliens', 'Animals', 'Cooking', 'Crossdressing', 'Delinquents', 'Demons', 'Ecchi', 'Genderswap', 'Ghosts', 'Gore', 'Gyaru', 'Harem', 'Incest', 'Loli', 'Mafia', 'Magic', 'Martial-Arts', 'Military', 'Monster-Girls', 'Monsters', 'Music', 'Ninja', 'Office-Workers', 'Police', 'Post-Apocalyptic', 'Reincarnation', 'Reverse-Harem', 'Samurai', 'School-Life', 'Shota', 'Smut', 'Supernatural', 'Survival', 'Time-Travel', 'Traditional-Games', 'Vampires', 'Video-Games', 'Villainess', 'Virtual-Reality', 'Zombies'];
        return new ArrayResoruce(true, '', $result);
    }

    public function jenis()
    {
        $result = ['Manga', 'Manhwa', 'Manhua'];
        return new ArrayResoruce(true, '', $result);
    }

    public function listgenre($genre, $page)
    {
        $url = $page == '1' ? 'https://komikindo2.com/daftar-manga/?genre%5B%5D=' . $genre . '&status=&type=&format=0&order=&title=' : 'https://komikindo2.com/daftar-manga/page/' . $page . '/?genre%5B0%5D=' . $genre . '&status&type&format=0&order&title';
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $url);
        $data = $crawler->filter('.listupd .animposx');

        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->children('a')->attr('href')),
                'img' => $v->filter('.limit')->children('img')->count() > 0
                    ? $v->filter('.limit')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),
                'ratting' => $v->filter('.adds .rating')->text(),

            ];
        });

        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        $crawler2 = $browser->request('GET', 'https://komikindo2.com/daftar-manga/?genre%5B%5D=' . $genre . '&status=&type=&format=0&order=&title=');
        $page = $crawler->filter('.pagination');
        $page2 = $crawler2->filter('.pagination');

        $response = [
            'current_page' => $page->filter('.page-numbers.current')->text(),
            'total_page' => $page2->filter('.page-numbers')->eq($page2->filter('.page-numbers')->count() - 2)->text(),
            'data' => $result,
        ];

        return new ArrayResoruce(true, '', $response);
    }

    public function listtheme($theme, $page)
    {
        $url = $page == '1' ? 'https://komikindo2.com/daftar-manga/?tema%5B%5D=' . $theme . '&status=&type=&format=&order=&title=' : 'https://komikindo2.com/daftar-manga/page/' . $page . '/?tema%5B0%5D=' . $theme . '&status&type&format&order&title';
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $url);
        $data = $crawler->filter('.listupd .animposx');

        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->children('a')->attr('href')),
                'img' => $v->filter('.limit')->children('img')->count() > 0
                    ? $v->filter('.limit')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),
                'ratting' => $v->filter('.adds .rating')->text(),

            ];
        });

        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        $crawler2 = $browser->request('GET', 'https://komikindo2.com/daftar-manga/?tema%5B%5D=' . $theme . '&status=&type=&format=&order=&title=');
        $page = $crawler->filter('.pagination');
        $page2 = $crawler2->filter('.pagination');

        $response = [
            'current_page' => $page->filter('.page-numbers.current')->text(),
            'total_page' => $page2->filter('.page-numbers')->eq($page2->filter('.page-numbers')->count() - 2)->text(),
            'data' => $result,
        ];

        return new ArrayResoruce(true, '', $response);
    }

    public function listjenis($jenis, $page)
    {
        $url = $page == '1' ? 'https://komikindo2.com/daftar-manga/?status=&type=' . $jenis . '&format=&order=&title=' : 'https://komikindo2.com/daftar-manga/page/' . $page . '/?status&type=' . $jenis . '&format&order&title';
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $url);
        $data = $crawler->filter('.listupd .animposx');

        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->children('a')->attr('href')),
                'img' => $v->filter('.limit')->children('img')->count() > 0
                    ? $v->filter('.limit')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),
                'ratting' => $v->filter('.adds .rating')->text(),

            ];
        });

        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        $crawler2 = $browser->request('GET', 'https://komikindo2.com/daftar-manga/?status=&type=' . $jenis . '&format=&order=&title=');
        $page = $crawler->filter('.pagination');
        $page2 = $crawler2->filter('.pagination');

        $response = [
            'current_page' => $page->filter('.page-numbers.current')->text(),
            'total_page' => $page2->filter('.page-numbers')->eq($page2->filter('.page-numbers')->count() - 2)->text(),
            'data' => $result,
        ];

        return new ArrayResoruce(true, '', $response);
    }

    public function detail($id)
    {
        $id = 'https://komikindo2.com/komik/' . $id;
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $id);
        $data = $crawler->filter('.postbody');
        $response = [];
        $response['judul'] = $data->filter('.entry-title')->text();
        $response['img'] = $data->filter('.thumb')->children('img')->attr('src');
        $response['ratting'] =  $data->filter('.thumb .rt .clearfix.archiveanime-rating')->children('i')->text();
        $response['judul_alternatif'] = $data->filter('.infox .spe')->children('span')->each(fn($v) => strpos($v->text(), 'Judul Alternatif:') !== false ? trim(str_replace('Judul Alternatif:', '', $v->text())) : null);
        $response['judul_alternatif'] = array_filter($response['judul_alternatif'], fn($item) => !is_null($item));
        $response['judul_alternatif'] = implode(' ', $response['judul_alternatif']);

        $response['status'] = $data->filter('.infox .spe')->children('span')->each(fn($v) => strpos($v->text(), 'Status:') !== false ? trim(str_replace('Status:', '', $v->text())) : null);
        $response['status'] = array_filter($response['status'], fn($item) => !is_null($item));
        $response['status'] = implode(' ', $response['status']);

        $response['pengarang'] = $data->filter('.infox .spe')->children('span')->each(fn($v) => strpos($v->text(), 'Pengarang:') !== false ? trim(str_replace('Pengarang:', '', $v->text())) : null);
        $response['pengarang'] = array_filter($response['pengarang'], fn($item) => !is_null($item));
        $response['pengarang'] = implode(' ', $response['pengarang']);

        $response['ilustrator'] = $data->filter('.infox .spe')->children('span')->each(fn($v) => strpos($v->text(), 'Ilustrator:') !== false ? trim(str_replace('Ilustrator:', '', $v->text())) : null);
        $response['ilustrator'] = array_filter($response['ilustrator'], fn($item) => !is_null($item));
        $response['ilustrator'] = implode(' ', $response['ilustrator']);

        $response['jenis'] = $data->filter('.infox .spe')->children('span')->each(fn($v) => strpos($v->text(), 'Jenis Komik:') !== false ? trim(str_replace('Jenis Komik:', '', $v->text())) : null);
        $response['jenis'] = array_filter($response['jenis'], fn($item) => !is_null($item));
        $response['jenis'] = implode(' ', $response['jenis']);

        $response['tema'] = $data->filter('.infox .spe')->children('span')->each(function ($v) {
            if (strpos($v->text(), 'Tema:') !== false) {
                return $v->children('a')->each(function ($b) {
                    return $b->text();
                });
            }
        });
        $response['tema'] = array_filter($response['tema'], fn($item) => !is_null($item));
        $response['tema'] = call_user_func_array('array_merge', $response['tema']);

        $response['genre'] = $data->filter('.genre-info ')->children('a')->each(function ($v) {
            return $v->text();
        });

        $response['short_sinopsis'] = $data->filter('.shortcsc.sht2')->text();
        $response['sinopsis'] = trim(str_replace(['\\', '"'], ['', ''], $data->filter('.tabsarea #sinopsis')->text() ?? 'null'));
        $response['spoiler'] = $data->filter('.spoiler  .spoiler-img')->count() == 0 ? [] :  $data->filter('.spoiler  .spoiler-img')->each(function ($v) {
            return  $v->children('img')->attr('src');
        });
        $response['mirip'] = $data->filter('#mirip .serieslist')->children('ul')->children('li')->count() == 0 ? [] : $data->filter('#mirip .serieslist')->children('ul')->children('li')->each(function ($v) {
            $jenis = $v->filter('.extras')->each(function ($v) {
                return trim(str_replace($v->filter('b')->text(), '', $v->text()));
            });
            return  [
                'url' => str_replace('https://komikindo2.com/komik/', '', $v->filter('.imgseries')->children('a')->attr('href')),
                'img' => $v->filter('.imgseries')->children('a')->children('img')->attr('src'),
                'title' => $v->filter('.leftseries .series')->text(),
                'subtitle' => $v->filter('.excerptmirip')->text(),
                'type' => $v->filter('.imgseries .series .typeflag ')->attr('class'),
                'jenis' => implode(' ', $jenis),
            ];
        });

        $response['chapter'] = $data->filter('.eps_lst #chapter_list')->children('ul')->children('li')->count() == 0 ? [] : $data->filter('.eps_lst #chapter_list')->children('ul')->children('li')->each(function ($v) {
            return  [
                'url' => str_replace('https://komikindo2.com/', '', $v->filter('.lchx')->children('a')->attr('href')),
                'chapter' => $v->filter('.lchx')->text(),
                'update' => $v->filter('.dt')->text()
            ];
        });
        return new ArrayResoruce(true, '', $response);
    }

    public function baca($id)
    {
        $url = 'https://komikindo2.com/' . $id;

        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $url);
        $data = $crawler->filter('#content');

        $response = [];

        $response['title'] = $data->filter('.chapter-content .dtlx .entry-title')->text();

        $response['back_chapter'] = $data->filter('.chapter-content .navig .nextprev')->children('a[rel="prev"]')->each(function ($v) {
            return $v->attr('href');
        });
        $response['back_chapter'] = array_filter($response['back_chapter'], fn($item) => !is_null($item));
        $response['back_chapter'] = str_replace('https://komikindo2.com/', '',  array_shift($response['back_chapter']));

        $response['next_chapter'] = $data->filter('.chapter-content .navig .nextprev')->children('a[rel="next"]')->each(function ($v) {
            return $v->attr('href');
        });
        $response['next_chapter'] = array_filter($response['next_chapter'], fn($item) => !is_null($item));
        $response['next_chapter'] = str_replace('https://komikindo2.com/', '', array_shift($response['next_chapter']));

        $response['list'] = $data->filter('.chapter-content #chimg-auh')->children('img')->each(function ($v) {
            return $v->attr('src');
        });
        return new ArrayResoruce(true, '', $response);
    }


    public function search($id)
    {
        $url = 'https://komikindo2.com/?s=' . $id;
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $url);
        $data = $crawler->filter('.film-list .animposx');
        $result = $data->each(function (Crawler $v) {
            return [
                'link' => str_replace('https://komikindo2.com/komik/', '', $v->children('a')->attr('href')),
                'img' => $v->filter('.limit')->children('img')->count() > 0
                    ? $v->filter('.limit')->children('img')->attr('src')
                    : null,
                'title' => $v->filter('.tt')->text(),
                'ratting' => $v->filter('.adds .rating')->children('i')->text(),
                'type' => $v->filter('.typeflag ')->attr('class'),
            ];
        });
        $result = collect($result)->map(function ($v) {
            $v['type'] = str_replace('typeflag', '', $v['type']);
            return $v;
        });

        return new ArrayResoruce(true, '', $result);
    }
}
