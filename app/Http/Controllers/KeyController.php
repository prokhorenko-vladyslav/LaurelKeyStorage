<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeyUpdate;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = Auth::user()->keys()->orderByDesc('id')->paginate(10);
        return view('keys.index', [
            'keys' => $keys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keys.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeyUpdate $request)
    {
        $key = new Key($request->validated());
        $key->user()->associate(Auth::user());
        $key->save();

        if (!empty($request->file('file'))) {
            if ($request->file('file')->getClientMimeType() !== 'application/octet-stream') {
                return redirect()->back()->with('errors', collect('SSH key is invalid'));
            }

            $key->filepath = $request->file('file')->storeAs('keys/' . Auth::user()->id . "/{$key->id}", $request->file('file')->getClientOriginalName());
            $key->save();
        }
        return redirect()->route('key.show', $key->id)->with('status', 'Key has been stored');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$key = Auth::user()->keys()->find($id)) {
            return redirect()->back()->with('errors', collect('Key has not been found'));
        }

        return view('keys.show', [
            'key' => $key
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$key = Auth::user()->keys()->find($id)) {
            return redirect()->back()->with('errors', collect('Key has not been found'));
        }

        return view('keys.update', [
            'key' => $key
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeyUpdate $request, $id)
    {
        if (!$key = Auth::user()->keys()->find($id)) {
            return redirect()->route('key.index')->with('errors', collect('Key has not been found'));
        }

        $key->fill($request->validated());
        $key->save();

        if (!empty($request->file('file'))) {
            if ($request->file('file')->getClientMimeType() !== 'application/octet-stream') {
                return redirect()->back()->with('errors', collect('SSH key is invalid'));
            }

            $key->filepath = $request->file('file')->storeAs('keys/' . Auth::user()->id . "/{$key->id}", $request->file('file')->getClientOriginalName());
            $key->save();
        }
        return redirect()->route('key.show', $key->id)->with('status', 'Key has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->keys()->find($id)->delete();
        return redirect()->back()->with('status', 'Key has been deleted');
    }
}
