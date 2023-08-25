<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function traineenotesEntry(Request $request)
    {
        $trainee = Auth::guard('sanctum-trainee')->user();

        if (!$trainee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $data = $request->validate([
            'task_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        // Assuming you have a logged-in trainee ID obtained from authentication
        $traineeId = $trainee->trainee_id;
        $note = new Note([
            'user_id' => $traineeId,
            'task_id' => $data['task_id'],
            'role' => 'trainee',
            'content' => $data['content'],
        ]);

        $note->save();

        return response()->json(['message' => 'Note saved successfully']);
    }

    public function traineeeditNotes(Request $request)
    {
        $trainee = Auth::guard('sanctum-trainee')->user();

        if (!$trainee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Retrieve the trainee ID from the authenticated user
        $traineeId = $trainee->trainee_id;

        $task_id = $request->input('task_id');
        $content = $request->input('content'); // Update this line to use 'content' instead of 'notes'
        $role = 'trainee';

        $note = Note::where('user_id', $traineeId)
            ->where('task_id', $task_id)
            ->where('role', $role)
            ->first();

        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $note->content = $content; // Update the 'notes' field to 'content'
        $note->save();

        return response()->json(['message' => 'Note updated successfully'], 200);
    }


    public function traineeshowNotes($traineeId, $taskId)
    {
        try {
            $notes = Note::where('user_id', $traineeId)
                ->where('task_id', $taskId)
                ->get();

            return response()->json(['content' => $notes], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch notes'], 500);
        }
    }

        //INSTRUCTOR NOTES

    public function insnotesEntry(Request $request)
    {
        $instructor = Auth::guard('sanctum-instructor')->user();

        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $data = $request->validate([
            'task_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        // Assuming you have a logged-in trainee ID obtained from authentication
        $instructorId = $instructor->instructor_id;
        $note = new Note([
            'user_id' => $instructorId,
            'task_id' => $data['task_id'],
            'role' => 'instructor',
            'content' => $data['content'],
        ]);

        $note->save();

        return response()->json(['message' => 'Note saved successfully']);
    }

    public function inseditNotes(Request $request)
    {
        $instructor = Auth::guard('sanctum-instructor')->user();

        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Retrieve the trainee ID from the authenticated user
        $instructorId = $instructor->instructor_id;

        $task_id = $request->input('task_id');
        $content = $request->input('content'); // Update this line to use 'content' instead of 'notes'
        $role = 'instructor';

        $note = Note::where('user_id', $instructorId)
            ->where('task_id', $task_id)
            ->where('role', $role)
            ->first();

        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $note->content = $content; // Update the 'notes' field to 'content'
        $note->save();

        return response()->json(['message' => 'Note updated successfully'], 200);
    }


    public function insshowNotes($instructorId, $taskId)
    {
        $instructor = Auth::guard('sanctum-instructor')->user();

        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $notes = Note::where('user_id', $instructorId)
                ->where('task_id', $taskId)
                ->where('role', 'instructor')
                ->get();

            return response()->json(['content' => $notes], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch notes'], 500);
        }
    }

    public function fetchTraineeNotes($traineeId, $taskId)
    {
        $instructor = Auth::guard('sanctum-instructor')->user();

        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $notes = Note::where('user_id', $traineeId)
                ->where('task_id', $taskId)
                //->where('role', 'trainee')
                ->get();

            return response()->json(['content' => $notes], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch notes'], 500);
        }
    }
}