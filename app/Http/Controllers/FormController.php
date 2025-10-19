<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use PDF; // Make sure barryvdh/laravel-dompdf is installed


class FormController extends Controller
{
    public function index()
    {
        // $users = UserInfo::latest()->get();
        $users = UserInfo::latest()->paginate(5);
        return view('pages.index', compact('users'));
    }

    public function view($id)
    {
        $user = UserInfo::findOrFail($id);
        return view('pages.view', compact('user'));
    }

    public function edit($id)
    {
        $user = UserInfo::findOrFail($id);
        return view('pages.form', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Process Education
        $education = [];
        if ($request->has('education_institute')) {
            foreach ($request->education_institute as $index => $val) {
                $education[] = [
                    'institute' => $val,
                    'department' => $request->education_department[$index] ?? '',
                    'result' => $request->education_result[$index] ?? '',
                    'year' => $request->education_year[$index] ?? '',
                ];
            }
        }

        // Process Experience
        $experience = [];
        if ($request->has('job_title')) {
            foreach ($request->job_title as $index => $val) {
                $experience[] = [
                    'title' => $val,
                    'company' => $request->job_company[$index] ?? '',
                    'duration' => $request->job_duration[$index] ?? '',
                    'description' => $request->job_description[$index] ?? '',
                ];
            }
        }

        // Process Cropped Image (only if a new image is uploaded)
        $imagePaths = [];
        if ($request->has('cropped_image') && !empty($request->cropped_image)) {
            $base64Image = $request->input('cropped_image');
            $image_parts = explode(";base64,", $base64Image);

            if (count($image_parts) === 2) {
                $image_base64 = base64_decode($image_parts[1]);
                $imageName = uniqid() . '.png';
                $path = 'images/' . $imageName;
                \Storage::disk('public')->put($path, $image_base64);

                $imagePaths[] = $path;
            }
        } else {
            // Keep existing image if no new one is uploaded
            $existingUser = UserInfo::findOrFail($id);
            $existingImages = json_decode($existingUser->images, true);
            if ($existingImages) {
                $imagePaths = $existingImages;
            }
        }

        // Final Data
        $userData = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'summary' => $request->summary,
            'location' => $request->location,
            'linkedin' => $request->linkedin,
            'education' => json_encode($education),
            'experience' => json_encode($experience),
            'skills' => $request->skills,
            'references' => json_encode($request->input('references', [])),
            'images' => json_encode($imagePaths),
        ];

        UserInfo::where('id', $id)->update($userData);

        return redirect()->route('index')->with('success', 'Form updated successfully!');
    }

    public function delete($id)
    {
        UserInfo::destroy($id);
        return redirect()->route('index')->with('success', 'Entry deleted.');
    }


    public function submit(Request $request)
    {
        // Process Education
        $education = [];
        if ($request->has('education_institute')) {
            foreach ($request->education_institute as $index => $val) {
                $education[] = [
                    'institute' => $val,
                    'department' => $request->education_department[$index] ?? '',
                    'result' => $request->education_result[$index] ?? '',
                    'year' => $request->education_year[$index] ?? '',
                ];
            }
        }

        // Process Experience
        $experience = [];
        if ($request->has('job_title')) {
            foreach ($request->job_title as $index => $val) {
                $experience[] = [
                    'title' => $val,
                    'company' => $request->job_company[$index] ?? '',
                    'duration' => $request->job_duration[$index] ?? '',
                    'description' => $request->job_description[$index] ?? '',
                ];
            }
        }

        // Process Cropped Image
        $imagePaths = [];
        if ($request->has('cropped_image')) {
            $base64Image = $request->input('cropped_image');
            $image_parts = explode(";base64,", $base64Image);

            if (count($image_parts) === 2) {
                $image_base64 = base64_decode($image_parts[1]);
                $imageName = uniqid() . '.png';
                $path = 'images/' . $imageName;
                \Storage::disk('public')->put($path, $image_base64);

                $imagePaths[] = $path;
            }
        }

        // Final Data
        $userData = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'summary' => $request->summary,
            'location' => $request->location,
            'linkedin' => $request->linkedin,
            'education' => json_encode($education),
            'experience' => json_encode($experience),
            'skills' => $request->skills,
            'references' => json_encode($request->input('references', [])),
            'images' => json_encode($imagePaths),
        ];

        UserInfo::create($userData);

        return redirect()->route('index')->with('success', 'Form submitted successfully!');
    }
}
