<?php


namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::all();
        return view('admin.conferences.index', compact('conferences'));
    }

    public function create()
    {
        $categories = DB::table('categories')
            ->where('categories.name', 'conference')
            ->get();
        $topics = Topic::all();

        return view('admin.conferences.create', compact('categories', 'topics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'topic_id' => 'required|exists:topics,id',
            'description' => 'nullable|string',
            'papers.*' => 'nullable|mimes:pdf|max:10240', // 10MB per file
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'conference_website' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'status' => 'required|in:open,reviewing,accepted,published,closed',
        ]);

        $mergedFileName = null;

        if ($request->hasFile('papers')) {
            $pdf = new Fpdi();
            $tempPaths = [];

            foreach ($request->file('papers') as $file) {
                $tempPath = $file->store('temp_pdfs');
                $fullPath = storage_path('app/' . $tempPath);
                $tempPaths[] = $fullPath;

                $pageCount = $pdf->setSourceFile($fullPath);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $template = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($template);
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($template);
                }
            }

            $mergedFileName = 'papers/merged_' . Str::random(10) . '_' . Carbon::now()->timestamp . '.pdf';
            $mergedPath = storage_path('app/public/' . $mergedFileName);
            $pdf->Output($mergedPath, 'F');

            // Clean up temp files
            foreach ($tempPaths as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $conference = Conference::create([
            'category_id' => $validated['category_id'],
            'topic_id' => $validated['topic_id'],
            'description' => $validated['description'] ?? null,
            'paper_path' => $mergedFileName,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'conference_website' => $validated['conference_website'] ?? null,
            'contact_email' => $validated['contact_email'] ?? null,
            'status' => $validated['status'],
            'reviewer_id' => null,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created and papers merged.');
    }

    public function edit(Conference $conference)
    {
        $categories = Category::all();
        $topics = Topic::all();

        return view('admin.conferences.edit', compact('conference', 'categories', 'topics'));
    }

    public function update(Request $request, Conference $conference)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'topic_id' => 'required|exists:topics,id',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'conference_website' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'status' => 'required|in:open,reviewing,accepted,published,closed',
        ]);

        $conference->update($validated);

        return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully.');
    }

    public function destroy(Conference $conference)
    {
        if ($conference->paper_path && Storage::disk('public')->exists($conference->paper_path)) {
            Storage::disk('public')->delete($conference->paper_path);
        }

        $conference->delete();

        return redirect()->route('admin.conferences.index')->with('success', 'Conference deleted successfully.');
    }
}
