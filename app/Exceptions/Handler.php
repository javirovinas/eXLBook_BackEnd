<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function render($request, Throwable $exception)
{
    if ($exception instanceof MethodNotAllowedHttpException) {
        return response()->json(['error' => 'The ' . $request->method() . ' method is not allowed'], 405);
    }

    if ($exception instanceof ValidationException) {
        return response()->json(['error' => $exception->validator->errors()->first()], 400);
    }

    if ($request->isMethod('post') && $request->route()->uri() === 'assignlogbooks') {
        $logbook_name = $request->input('logbook_name');
        $date = $request->input('date');
        $trainee_id = $request->input('trainee_id');
        $instructor_id = $request->input('instructor_id');
        $dateRegex = '/^\d{4}-\d{2}-\d{2}$/';

        if (!preg_match($dateRegex, $date)) {
            return response()->json(['error' => 'Invalid date format. The date must be in YYYY-MM-DD format.'], 400);
        }

        if (empty($logbook_name)) {
            return response()->json(['error' => 'Logbook name is required.'], 400);
        }
        if (empty($date)) {
            return response()->json(['error' => 'Date is required.'], 400);
        }
        if (empty($trainee_id)) {
            return response()->json(['error' => 'Trainee ID is required.'], 400);
        }
        if (empty($instructor_id)) {
            return response()->json(['error' => 'Instructor ID is required.'], 400);
        }


    }

    if ($request->isMethod('post')) {
        // Retrieve the input data
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $uid = $request->input('uid');

        // Validate the input data
        if (empty($username) || empty($password)) {
            return response()->json(['error' => 'Username and password are required.'], 400);
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return response()->json(['error' => 'Invalid username format.'], 400);
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            return response()->json(['error' => 'Invalid password format.'], 400);
        }

        if (strpos($username, ' ') !== false) {
            return response()->json(['error' => 'Username cannot contain spaces.'], 400);
        }

        if (strpos($password, ' ') !== false) {
            return response()->json(['error' => 'Password cannot contain spaces.'], 400);
        }

        if (strlen($username) > 54) {
            return response()->json(['error' => 'Username is too long.'], 400);
        }

        if (strlen($password) < 6) {
            return response()->json(['error' => 'Password must be at least 6 characters long.'], 400);
        }

        // Check if username already exists in the database
        try {
            $admin = \App\Models\Admin_login::where('username', $username)->first();
            if ($admin) {
                return response()->json(['error' => 'Username already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check username existence.'], 500);
        }

        try {
            $instructor = \App\Models\Instructor_details::where('email', $email)->first();
            if ($instructor) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return response()->json(['error' => 'Invalid email format.'], 400);
                }
                return response()->json(['error' => 'Email already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check email existence.'], 500);
        }

        try {
            $instructor_user = \App\Models\Instructor_details::where('i_username', $username)->first();
            if ($instructor_user) {
                return response()->json(['error' => 'Username already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check instructor username existence.'], 500);
        }

        try {
            $instructor_uid = \App\Models\Instructor_details::where('uid', $uid)->first();
            if ($instructor_uid) {
                return response()->json(['error' => 'UID already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check instructor UID existence.'], 500);
        }

        try {
            $trainee = \App\Models\Trainee_details::where('email', $email)->first();
            if ($trainee) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return response()->json(['error' => 'Invalid email format.'], 400);
                }
                return response()->json(['error' => 'Email already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check email existence.'], 500);
        }

        try {
            $trainee_user = \App\Models\trainee_details::where('t_username', $username)->first();
            if ($trainee_user) {
                return response()->json(['error' => 'Username already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check trainee username existence.'], 500);
        }

        try {
            $trainee_uid = \App\Models\trainee_details::where('uid', $uid)->first();
            if ($trainee_uid) {
                return response()->json(['error' => 'UID already exists.'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to check trainee UID existence.'], 500);
        }
    
    }
    if ($exception instanceof RouteNotFoundException) {
        return response()->json(['error' => 'Missing or incorrect API token.'], 404);
    }

    if ($exception instanceof AuthenticationException) {
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    if ($exception instanceof HttpException && $exception->getStatusCode() === 500) {
        return response()->json(['error' => 'Internal server error.'], 500);
    }
    

    return parent::render($request, $exception);
}

}
