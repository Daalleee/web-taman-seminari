<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Faq;
use App\Models\News;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Teacher;
use App\Models\Principal;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $banners = Banner::where('is_active', true)->get();
        $faqs = Faq::orderBy('order')->get();
        $newsList = News::latest()->get();
        $activities = Activity::latest()->take(6)->get();
        $galleries = Gallery::latest()->take(8)->get();
        $principal = Principal::where('is_active', true)->first();
        $teachers = Teacher::where('is_active', true)->orderBy('order')->get();
        $settings = Setting::all()->pluck('value', 'key');

        return view('public.home', compact('banners', 'faqs', 'newsList', 'activities', 'galleries', 'principal', 'teachers', 'settings'));
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        Message::create($request->only(['name', 'email', 'message']));

        return redirect()->route('home')->with('success', 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
    }

    public function newsDetail(News $news)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $latestNews = News::where('id', '!=', $news->id)->latest()->take(3)->get();
        return view('public.news-detail', compact('news', 'settings', 'latestNews'));
    }

    public function activityDetail(Activity $activity)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $latestActivities = Activity::where('id', '!=', $activity->id)->latest()->take(3)->get();
        return view('public.activity-detail', compact('activity', 'settings', 'latestActivities'));
    }
}
