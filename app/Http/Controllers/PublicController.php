<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Faq;
use App\Models\News;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Setting;

class PublicController extends Controller
{
    public function home()
    {
        $banners = Banner::where('is_active', true)->get();
        $faqs = Faq::orderBy('order')->get();
        $newsList = News::orderBy('published_at', 'desc')->get();
        $activities = Activity::orderBy('activity_date', 'desc')->take(6)->get();
        $galleries = Gallery::latest()->take(8)->get();
        $settings = Setting::all()->pluck('value', 'key');

        return view('public.home', compact('banners', 'faqs', 'newsList', 'activities', 'galleries', 'settings'));
    }

    public function newsDetail(News $news)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $latestNews = News::where('id', '!=', $news->id)->orderBy('published_at', 'desc')->take(3)->get();
        return view('public.news-detail', compact('news', 'settings', 'latestNews'));
    }

    public function activityDetail(Activity $activity)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $latestActivities = Activity::where('id', '!=', $activity->id)->orderBy('activity_date', 'desc')->take(3)->get();
        return view('public.activity-detail', compact('activity', 'settings', 'latestActivities'));
    }
}
