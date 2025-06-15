<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        ContactInfo::create($request->only('name', 'email', 'phone', 'message'));

        return redirect()->route('contact.show')->with('success', 'Ваше повідомлення надіслано успішно!');
    }

}
