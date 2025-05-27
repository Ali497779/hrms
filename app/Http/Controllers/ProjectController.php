<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view("project.list", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::with('user')->get();
        $employees = Employee::with('user')->get();
        return view("project.create", compact("customers","employees"));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            // Step 1: Validate request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'customer_id' => 'required|exists:customers,id',
                'type' => 'required|string|min:3',
                'description' => 'nullable|string',
            ], [
                'customer_id.required' => 'Select Customer Please.',
                'customer_id.exists' => 'Selected customer does not exist.',
            ]);

            
            
            // Step 2: Create project folder
            $projectFolder = Str::slug($request->title); // Create URL-friendly folder name
            $attachmentPath = "assets/attachments/{$projectFolder}/";
            $fullPath = public_path($attachmentPath);
            
            // Create directory if it doesn't exist
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }
            
            // Step 3: Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $fileName = time() . '_' . Str::random(10) . '_' . $originalName;
                    
                    // Move file to project folder
                    $file->move($fullPath, $fileName);
                    
                    // Store file info
                    $attachments[] = [
                        'name' => $originalName,
                        'path' => $attachmentPath . $fileName,
                        'uploaded_at' => now()->toDateTimeString()
                    ];
                }
            }

            // Step 4: Create project record
            $project = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'customer_id' => $request->customer_id,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'attachments' => !empty($attachments) ? json_encode($attachments) : null,
                'created_by' => Auth::user()->id,
            ]);

            // if ($request->has('members')) {
            //     $project->members()->attach($request->members);
            // }

            return redirect()->route('project.list')->with('success', 'Project created successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('validation_errors', 'Please fix the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the project: ' . $e->getMessage());
        }
    }

    
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
