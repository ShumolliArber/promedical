<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactUsController extends Controller implements HasMiddleware
{
  public static function middleware(): array
  {
    return [
      new Middleware('permission:contact-us-read|contact-us-delete', only: ['index', 'show']),
      new Middleware('permission:contact-us-delete', only: ['destroy']),
    ];
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $contacts = $this->filter($request)->paginate(10);
    return view('contact-us.index', compact('contacts'));
  }

  /**
   * Filter function
   *
   * @param Request $request
   * @return Illuminate\Database\Eloquent\Builder
   */
  private function filter(Request $request)
  {
    $query = ContactUs::latest();

    if ($request->name)
      $query->where('name', 'like', $request->name . '%');

    if ($request->email)
      $query->where('email', 'like', $request->email . '%');

    return $query;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\ContactUs  $contactUs
   * @return \Illuminate\Http\Response
   */
  public function show(ContactUs $contact)
  {
    return view('contact-us.show', compact('contact'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\ContactUs  $contactUs
   * @return \Illuminate\Http\Response
   */
  public function edit(ContactUs $contactUs)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\ContactUs  $contactUs
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ContactUs $contactUs)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\ContactUs  $contactUs
   * @return \Illuminate\Http\Response
   */
  public function destroy(ContactUs $contact)
  {
    $contact->delete();
    return redirect()->back();
  }
}
