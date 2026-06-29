<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\News;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'banners' => Banner::count(),
            'news' => News::count(),
            'activities' => Activity::count(),
            'galleries' => Gallery::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // --- BANNERS ---
    public function banners()
    {
        $banners = Banner::all();
        return view('admin.banners', compact('banners'));
    }

    public function storeBanner(Request $request)
    {
        $request->validate(['image' => 'required|image', 'title' => 'nullable', 'subtitle' => 'nullable']);
        $path = $request->file('image')->store('banners', 'public');
        Banner::create(['title' => $request->title, 'subtitle' => $request->subtitle, 'image_path' => $path]);
        return back()->with('success', 'Banner berhasil ditambahkan');
    }

    public function updateBanner(Request $request, Banner $banner)
    {
        $request->validate(['image' => 'nullable|image', 'title' => 'nullable', 'subtitle' => 'nullable']);
        $data = ['title' => $request->title, 'subtitle' => $request->subtitle];
        
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($banner->image_path);
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }
        
        $banner->update($data);
        return back()->with('success', 'Banner berhasil diperbarui');
    }

    public function deleteBanner(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();
        return back()->with('success', 'Banner berhasil dihapus');
    }

    // --- FAQS ---
    public function faqs()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $request->validate(['question' => 'required', 'answer' => 'required']);
        Faq::create(['question' => $request->question, 'answer' => $request->answer, 'order' => Faq::count() + 1]);
        return back()->with('success', 'FAQ berhasil ditambahkan');
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $request->validate(['question' => 'required', 'answer' => 'required']);
        $faq->update(['question' => $request->question, 'answer' => $request->answer]);
        return back()->with('success', 'FAQ berhasil diperbarui');
    }

    public function deleteFaq(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus');
    }

    // --- NEWS ---
    public function news()
    {
        $news = News::latest('published_at')->get();
        return view('admin.news', compact('news'));
    }

    public function storeNews(Request $request)
    {
        $request->validate(['title' => 'required', 'content' => 'required', 'image' => 'nullable|image', 'published_at' => 'required|date']);
        $path = $request->hasFile('image') ? $request->file('image')->store('news', 'public') : null;
        News::create(['title' => $request->title, 'content' => $request->content, 'image_path' => $path, 'published_at' => $request->published_at]);
        return back()->with('success', 'Berita berhasil dipublikasikan');
    }

    public function updateNews(Request $request, News $news)
    {
        $request->validate(['title' => 'required', 'content' => 'required', 'image' => 'nullable|image', 'published_at' => 'required|date']);
        $data = ['title' => $request->title, 'content' => $request->content, 'published_at' => $request->published_at];
        
        if ($request->hasFile('image')) {
            if ($news->image_path) Storage::disk('public')->delete($news->image_path);
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }
        
        $news->update($data);
        return back()->with('success', 'Berita berhasil diperbarui');
    }

    public function deleteNews(News $news)
    {
        if ($news->image_path) Storage::disk('public')->delete($news->image_path);
        $news->delete();
        return back()->with('success', 'Berita berhasil dihapus');
    }

    // --- ACTIVITIES ---
    public function activities()
    {
        $activities = Activity::orderBy('activity_date', 'desc')->get();
        return view('admin.activities', compact('activities'));
    }

    public function storeActivity(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'nullable|image', 'activity_date' => 'required|date']);
        $path = $request->hasFile('image') ? $request->file('image')->store('activities', 'public') : null;
        Activity::create(['title' => $request->title, 'description' => $request->description, 'image_path' => $path, 'activity_date' => $request->activity_date]);
        return back()->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function updateActivity(Request $request, Activity $activity)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'nullable|image', 'activity_date' => 'required|date']);
        $data = ['title' => $request->title, 'description' => $request->description, 'activity_date' => $request->activity_date];
        
        if ($request->hasFile('image')) {
            if ($activity->image_path) Storage::disk('public')->delete($activity->image_path);
            $data['image_path'] = $request->file('image')->store('activities', 'public');
        }
        
        $activity->update($data);
        return back()->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function deleteActivity(Activity $activity)
    {
        if ($activity->image_path) Storage::disk('public')->delete($activity->image_path);
        $activity->delete();
        return back()->with('success', 'Kegiatan berhasil dihapus');
    }

    // --- GALLERIES ---
    public function galleries()
    {
        $galleries = Gallery::all();
        return view('admin.galleries', compact('galleries'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate(['image' => 'required|image', 'title' => 'nullable']);
        $path = $request->file('image')->store('galleries', 'public');
        Gallery::create(['title' => $request->title, 'image_path' => $path]);
        return back()->with('success', 'Foto berhasil ditambahkan');
    }

    public function updateGallery(Request $request, Gallery $gallery)
    {
        $request->validate(['title' => 'nullable', 'image' => 'nullable|image']);
        $data = ['title' => $request->title];
        
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image_path);
            $data['image_path'] = $request->file('image')->store('galleries', 'public');
        }
        
        $gallery->update($data);
        return back()->with('success', 'Foto berhasil diperbarui');
    }

    public function deleteGallery(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus');
    }

    // --- SETTINGS ---
    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function storeSettings(Request $request)
    {
        $data = $request->except(['_token']);
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
