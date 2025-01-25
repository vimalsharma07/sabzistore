<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use Auth;
use DataTables;

class StoryController extends Controller
{
    public function create(Request $request){
        return view('admin.story.create');
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'type' => 'required|in:image,video',
        'priority' => 'required|integer',
        'status' => 'required|boolean',
        'files.*' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:20480', // 20MB max
    ]);

    $files = [];
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/stories');
            $file->move($destinationPath, $fileName);
            $files[] = 'uploads/stories/' . $fileName;
        }
    }

    $validatedData['files'] = json_encode($files);
    Story::create($validatedData);

    return redirect()->route('stories.index')->with('success', 'Story created successfully.');
}
 public function index()
    {
        $stories = Story::all();
        return view('admin.story.index', compact('stories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $story = Story::findOrFail($id);
        return view('admin.story.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'type' => 'required|in:image,video',
            'priority' => 'required|integer',
            'status' => 'required|in:active,inactive',
            'files' => 'nullable|file|mimes:jpeg,png,mp4',
        ]);

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('stories'), $filename);
            $story->files = 'stories/' . $filename;
        }

        $story->name = $request->name;
        $story->start_date = $request->start_date;
        $story->end_date = $request->end_date;
        $story->type = $request->type;
        $story->priority = $request->priority;
        $story->status = $request->status;
        $story->updated_at = Carbon::now();
        $story->save();

        return redirect()->route('stories.index')->with('success', 'Story updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        if ($story->files && file_exists(public_path($story->files))) {
            unlink(public_path($story->files));
        }

        $story->delete();

        return redirect()->route('stories.index')->with('success', 'Story deleted successfully.');
    }

    /**
     * Change the status of the story.
     */
    public function changeStatus($id)
    {
        $story = Story::findOrFail($id);
        $story->status = $story->status === 'active' ? 'inactive' : 'active';
        $story->save();

        return response()->json(['status' => 'success', 'message' => 'Story status updated.']);
    }


 

}
