<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    protected $model;

    public function __construct(Publisher $publisher)
    {
        $this->model = $publisher;
    }

    public function index()
    {
        $items = $this->model->with('books')->get();
        return response(['data' => $items, 'status' => 200]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required|unique:publishers|min:3',
            'fname' => 'required',
            'lname' => 'required',
        ]);

        $this->model->create($request->all());
        return $this->index();
    }
    public function destroy($id)
    {
        try {
            $item = $this->model->with('books')->findOrFail($id);
            $item->delete();
            return $this->index();
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }
    public function show($id)
    {
        try {
            $item = $this->model->with('books')->findOrFail($id);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }
    public function update($id, Request $request)
    {
        try {
            $item = $this->model->with('books')->findOrFail($id);
            $item->update($request->all());
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }
}
