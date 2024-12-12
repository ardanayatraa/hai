<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * List todos
     *
     * Get a list of all to-do items.
     *
     * @authenticated
     
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return the list of all todos in JSON format
        return response()->json(Todo::all());
    }

    /**
     * Store todo
     *
     * Add a new to-do item to the list.
     *
     * @bodyParam title string required
     * The title of the to-do item. Example: Buy groceries
     *
     * @bodyParam description string nullable
     * The description of the to-do item. Example: Milk, eggs, bread
     *
     * @bodyParam completed boolean required
     * The completion status of the to-do item. Example: false
     *
     * @authenticated
     * @response {
     *      "status": 200,
     *      "success": true,
     *      "data": {
     *          "id": 10,
     *          "title": "Buy groceries",
     *          "description": "Milk, eggs, bread",
     *          "completed": false
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
        ]);

        // Create a new to-do item
        $todo = Todo::create($request->all());

        // Return the created to-do item as a response
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $todo,
        ]);
    }

    /**
     * Get todo
     *
     * Get a to-do item by its unique ID.
     *
     * @pathParam todo integer required
     * The ID of the to-do item to retrieve. Example: 10
     *
     * @response {
     *      "status": 200,
     *      "success": true,
     *      "data": {
     *          "id": 10,
     *          "title": "Buy groceries",
     *          "description": "Milk, eggs, bread",
     *          "completed": false
     *      }
     * }
     * @authenticated
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        // Check if the to-do item exists
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }

        // Return the specific to-do item
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $todo,
        ]);
    }

    /**
     * Update todo
     *
     * Update an existing to-do item.
     *
     * @bodyParam title string required
     * The title of the to-do item. Example: Buy groceries
     *
     * @bodyParam description string nullable
     * The description of the to-do item. Example: Milk, eggs, bread
     *
     * @bodyParam completed boolean required
     * The completion status of the to-do item. Example: false
     *
     * @pathParam todo integer required
     * The ID of the to-do item to update. Example: 10
     *
     * @response {
     *      "status": 200,
     *      "success": true,
     *      "data": {
     *          "id": 10,
     *          "title": "Buy groceries",
     *          "description": "Milk, eggs, bread",
     *          "completed": true
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
        ]);

        // Update the to-do item
        $todo->update($request->all());

        // Return the updated to-do item
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $todo,
        ]);
    }

    /**
     * Delete todo
     *
     * Delete a to-do item by its ID.
     *
     * @pathParam todo integer required
     * The ID of the to-do item to delete. Example: 10
     *
     * @response {
     *      "status": 200,
     *      "success": true,
     *      "message": "Todo deleted successfully"
     * }
     * @authenticated
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        // Check if the to-do item exists
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }

        // Delete the to-do item
        $todo->delete();

        // Return a success message
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Todo deleted successfully',
        ]);
    }
}
