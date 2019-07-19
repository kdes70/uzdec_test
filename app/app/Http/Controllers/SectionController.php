<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sections\Create;
use App\Http\Requests\Sections\Update;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = (new Section())->with('users')->orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', $value);
        }

        $sections = $query->paginate(4);

        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::All();

        return view('sections.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Create $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {

        if ($request->hasFile('logo')) {
            $logo = $this->addLogo($request->file('logo'));
        }

        $section = Section::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'logo' => $logo ?? null,
        ]);

        if ($request->has('users')) {
            $section->users()->attach($request->get('users'));
        }

        return redirect()->route('sections.index', $section)->with('success',
            'Section ' . $section->name . ' has been created successfully!');;
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $users = User::All();

        $selected_user = $section->users()->pluck('id')->toArray();

        return view('sections.edit', compact('section','users', 'selected_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Update $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $section = Section::find($id);

        if ($request->hasFile('logo')) {
            $logo = $this->addLogo($request->file('logo'));

            if ($logo && $section->logo) {
                Storage::disk('public')->delete('logo/' . $section->logo);
            }
        }

        $section->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'logo' => $logo ?? $section->logo,
        ]);

        $section->users()->sync($request->get('users'));

        return redirect()->route('sections.index')->with('success',
            'Section ' . $section->name . ' has been updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        if ($section->exists()) {
            $section->delete();
        }

        return redirect()->route('section.index')->with('success',
            'Section ' . $section->name . ' has been deleted successfully!');
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function addLogo(UploadedFile $file): string
    {
        $file_name = Str::random(20) . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('public/logo', $file_name);

        return $file_name;

    }

}
