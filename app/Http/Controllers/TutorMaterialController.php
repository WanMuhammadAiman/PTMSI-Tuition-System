<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Subject;
use App\Models\Material;
use App\Models\Enrolment;

class TutorMaterialController extends Controller
{
    public function showPrimarySubjects()
    {
        $primarySubjects = Subject::where('level', 'primary')
            ->orderBy('name')
            ->get();


        return view('tutor.materials-primary', compact('primarySubjects'));
    }

    public function showSecondarySubjects(Request $request)
    {
        $selectedLevel = $request->input('class_level');
    
        $query = Subject::where('level', 'secondary')
            ->select('id', 'name', 'slug', 'class_level')
            ->orderBy('name');
    
        if ($selectedLevel) {
            $query->where('class_level', $selectedLevel);
        }
    
        $secondarySubjects = $query->get()
            ->unique('name') 
            ->values();
    
        return view('tutor.materials-secondary', compact('secondarySubjects', 'selectedLevel'));
    }
    

    public function showUploadPageSecondary($slug)
    {
        $subject = Subject::where('slug', $slug)->firstOrFail();
        return view('tutor.secondary-material.upload', compact('subject'));
    }

    public function uploadMaterial(Request $request)
    {
        $request->validate([
            'material' => 'required|file|max:10240',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $path = $request->file('material')->store('materials', 'public');
        $subject = Subject::findOrFail($request->subject_id);

        Material::create([
            'subject_id' => $subject->id,
            'file_path' => $path,
            'subject' => $subject->name,
            'user_id' => auth()->id(),
            'file_type' => $request->file('material')->getClientOriginalExtension(),
        ]);

        return redirect()->route('tutor.secondary.upload', ['slug' => $subject->slug])
            ->with([
                'success' => 'Material uploaded successfully!',
                'material_subject_slug' => $subject->slug,
            ]);
    }

    public function viewMaterials($slug)
    {
        // Find subject by its slug
        $subject = Subject::where('slug', $slug)->firstOrFail();
    
        // Get all materials for that subject
        $materials = Material::where('subject_id', $subject->id)->get();
    
        return view('tutor.primary-material.view-materials', compact('subject', 'materials'));
    }
    
    public function showPrimaryUpload($slug)
    {
        $primarySubject = Subject::where('slug', $slug)->firstOrFail();
        return view('tutor.primary-material.upload-unified', compact('primarySubject'));
    }
    
    
    public function handlePrimaryUpload(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'material' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);
    
        $subject = Subject::findOrFail($request->subject_id);
    
        $path = $request->file('material')->storeAs(
            'materials/' . $subject->id,
            time() . '_' . $request->file('material')->getClientOriginalName(),
            'public'
        );
    
        Material::create([
            'user_id' => auth()->id(),
            'subject_id' => $subject->id,
            'subject' => $subject->name,
            'file_path' => $path,
            'file_type' => $request->file('material')->getClientOriginalExtension(),
        ]);
    
        return redirect()->route('tutor.materials.primary.unified', ['slug' => $subject->slug])
            ->with([
                'success' => 'Material uploaded successfully!',
                'material_subject_slug' => $subject->slug,
            ]);
    }
    
 
    public function show($subject)
    {
        $materials = Material::where('subject', $subject)->latest()->get();
        return view('student.materials.subject', compact('materials', 'subject'));
    }

    public function studentSubjects()
    {
        $user = auth()->user();
        $subjects = Subject::whereIn('id', function ($query) use ($user) {
            $query->select('subject_id')
                ->from('enrolments')
                ->where('user_id', $user->id);
        })->get();

        return view('student.materials.index', compact('subjects'));
    }

    public function studentMaterials($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $materials = Material::where('subject_id', $subject_id)->get();

        return view('student.materials.subject', compact('materials', 'subject'));
    }

    public function viewSecondaryMaterials($slug)
    {
        $Secsubject = Subject::where('slug', $slug)->firstOrFail();
        $Secmaterials = Material::where('subject_id', $Secsubject->id)->get();

        return view('tutor.secondary-material.view-secmaterial', compact('Secsubject', 'Secmaterials'));
    }

    public function showSecondarySubjectMaterials(Subject $subject)
    {
        $materials = Material::where('subject_id', $subject->id)->get();
        return view('student.materials.secondary-view', compact('subject', 'materials'));
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        if (Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->back()->with('status', 'Material deleted successfully.');
    }
}
