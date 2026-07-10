<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\News;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Teacher;
use App\Models\Principal;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'banners' => Banner::count(),
            'news' => News::count(),
            'activities' => Activity::count(),
            'galleries' => Gallery::count(),
            'messages' => Message::count(),
            'unreadMessages' => Message::unread()->count(),
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
        $request->validate(['image' => 'required|image']);
        $path = $request->file('image')->store('banners', 'public');
        Banner::create(['image_path' => $path]);
        return back()->with('success', 'Banner berhasil ditambahkan');
    }

    public function updateBanner(Request $request, Banner $banner)
    {
        $request->validate(['image' => 'nullable|image']);
        $data = [];
        
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
        $news = News::latest()->get();
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
        $activities = Activity::latest()->get();
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
        $galleries = Gallery::latest()->get();
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

    // --- KEPALA SEKOLAH ---
    public function principal()
    {
        $principal = Principal::firstOrNew([]);
        return view('admin.principal', compact('principal'));
    }

    public function updatePrincipal(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
            'photo' => 'nullable|image',
        ]);
        $data = $request->only(['name', 'content']);
        $data['is_active'] = true;
        if ($request->hasFile('photo')) {
            $principal = Principal::first();
            if ($principal && $principal->photo_path) Storage::disk('public')->delete($principal->photo_path);
            $data['photo_path'] = $request->file('photo')->store('principals', 'public');
        }
        Principal::updateOrCreate(['id' => 1], $data);
        return back()->with('success', 'Data kepala sekolah berhasil diperbarui');
    }

    // --- GURU ---
    public function teachers()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.teachers', compact('teachers'));
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'photo' => 'nullable|image',
        ]);
        $data = $request->only(['name', 'role']);
        $data['content'] = $request->content ?? '';
        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('teachers', 'public');
        }
        Teacher::create($data);
        return back()->with('success', 'Guru berhasil ditambahkan');
    }

    public function updateTeacher(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'photo' => 'nullable|image',
        ]);
        $data = $request->only(['name', 'role']);
        $data['content'] = $request->content ?? '';
        if ($request->hasFile('photo')) {
            if ($teacher->photo_path) Storage::disk('public')->delete($teacher->photo_path);
            $data['photo_path'] = $request->file('photo')->store('teachers', 'public');
        }
        $teacher->update($data);
        return back()->with('success', 'Data guru berhasil diperbarui');
    }

    public function deleteTeacher(Teacher $teacher)
    {
        if ($teacher->photo_path) Storage::disk('public')->delete($teacher->photo_path);
        $teacher->delete();
        return back()->with('success', 'Guru berhasil dihapus');
    }

    // --- MESSAGES ---
    public function messages()
    {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function showMessage(Message $message)
    {
        $message->markAsRead();
        return response()->json($message);
    }

    public function deleteMessage(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus');
    }

    // --- SETTINGS ---
    private function getSettings()
    {
        return Setting::all()->pluck('value', 'key');
    }

    private function saveSettings($data)
    {
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function settingsProfile()
    {
        $settings = $this->getSettings();
        return view('admin.settings-profile', compact('settings'));
    }

    public function storeSettingsProfile(Request $request)
    {
        $this->saveSettings($request->except(['_token']));
        return back()->with('success', 'Profil sekolah berhasil diperbarui');
    }

    public function settingsVision()
    {
        $settings = $this->getSettings();
        return view('admin.settings-vision', compact('settings'));
    }

    public function storeSettingsVision(Request $request)
    {
        $this->saveSettings($request->except(['_token']));
        return back()->with('success', 'Visi berhasil diperbarui');
    }

    public function settingsMission()
    {
        $settings = $this->getSettings();
        return view('admin.settings-mission', compact('settings'));
    }

    public function storeSettingsMission(Request $request)
    {
        $this->saveSettings($request->except(['_token']));
        return back()->with('success', 'Misi berhasil diperbarui');
    }

    public function settingsContact()
    {
        $settings = $this->getSettings();
        return view('admin.settings-contact', compact('settings'));
    }

    public function storeSettingsContact(Request $request)
    {
        $this->saveSettings($request->except(['_token']));
        return back()->with('success', 'Kontak berhasil diperbarui');
    }

    public function settingsOperationalHours()
    {
        $settings = $this->getSettings();
        return view('admin.settings-operational-hours', compact('settings'));
    }

    public function storeSettingsOperationalHours(Request $request)
    {
        $this->saveSettings($request->except(['_token']));
        return back()->with('success', 'Jam operasional berhasil diperbarui');
    }

    // --- USER MANAGEMENT ---
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Admin berhasil ditambahkan');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['Tidak bisa menghapus akun sendiri.']);
        }
        $user->delete();
        return back()->with('success', 'Admin berhasil dihapus');
    }
}
